<?php

namespace App\Services;

use App\Traits\ConsumesExternalServiceTrait;
use App\Events\PaymentReferrerBonus;
use Spatie\Backup\Listeners\Listener;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\Statistics\UserService;
use App\Events\PaymentProcessed;
use App\Models\Payment;
use App\Models\Subscriber;
use App\Models\PrepaidPlan;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Carbon\Carbon;

class RazorpayService 
{
    use ConsumesExternalServiceTrait;

    protected $baseURI;
    protected $keyID;
    protected $keySecret;
    private $api;

    /**
     * Paypal payment processing, unless you are familiar with 
     * Paypal's REST API, we recommend not to modify core payment processing functionalities here.
     * Part that are writing data to the database can be edited as you prefer.
     */
    public function __construct()
    {
        $this->api = new UserService();

        $verify = $this->api->verify_license();

        if($verify['status']!=true){
            return false;
        }

        $this->baseURI = config('services.razorpay.base_uri');
        $this->keyID = config('services.razorpay.key_id');
        $this->keySecret = config('services.razorpay.key_secret');
    }


    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }


    public function decodeResponse($response)
    {
        return json_decode($response);
    }


    public function resolveAccessToken()
    {
        if ($this->api->api_url != 'https://license.berkine.space/') {
            return;
        }

        $credentials = base64_encode("{$this->keyID}:{$this->keySecret}");

        return "Basic {$credentials}";
    }


    public function handlePaymentSubscription(Request $request, SubscriptionPlan $id)
    {   
        if (!$id->razorpay_gateway_plan_id) {
            toastr()->error(__('Razorpay plan id is not set. Please contact the support team'));
            return redirect()->back();
        } 


        try {

            $price = intval($id->price * 100);
            $order = $this->createSubscription($id, $request->razorpay_email, $price);

        } catch (\Exception $e) {
            toastr()->error(__('Razorpay authentication error, verify your razorpay settings first'));
            return redirect()->back();
        }
        

        if ($order->status == 'created') {        

            $name = $request->razorpay_name;
            $email = $request->razorpay_email;
            $amount = '';
            $currency = '';
            session()->put('subscriptionID', $order->id);

            return view('user.plans.razorpay-checkout', compact('order', 'id', 'name', 'email', 'amount', 'currency'));
        } else {
            toastr()->error(__('There was an error with Razorpay connection, please try again'));
            return redirect()->back();
        }

    }


    public function handlePaymentPrePaid(Request $request, $id, $type)
    {   
        if ($request->type == 'lifetime') {
            $id = SubscriptionPlan::where('id', $id)->first();
            $type = 'lifetime';
        } else {
            $id = PrepaidPlan::where('id', $id)->first();
            $type = 'prepaid';
        }

        $tax_value = (config('payment.payment_tax') > 0) ? $tax = $id->price * config('payment.payment_tax') / 100 : 0;
        $total_value = $request->value;

        $name = $request->razorpay_name;
        $email = $request->razorpay_email;


        try {

            $price = intval($total_value * 100);
            $order = $this->createOrder($price, $request->currency);

        } catch (\Exception $e) {
            toastr()->error(__('Razorpay authentication error, verify your razorpay settings first 3'));
            return redirect()->back();
        }        

        if ($order->status == 'created') {

            $amount = $price;
            $currency = $id->currency;

            session()->put('order_id', $order->id);
            session()->put('type', $type);
            session()->put('plan_id', $id);
            session()->put('razorpay_price', $price);
            session()->put('razorpay_currency', $request->currency);

            return view('user.plans.razorpay-checkout', compact('order', 'id', 'name', 'email', 'amount', 'currency'));
        } else {
            toastr()->error(__('There was an error with Razorpay connection, please try again'));
            return redirect()->back();
        }

    }


    public function handleApproval(Request $request)
    {
        if (session()->has('order_id')) {
            $order_id = session()->get('order_id');
            $plan = session()->get('plan_id');    
            $type = session()->get('type');     

            $razorpay_payment_id = $request->razorpay_payment_id;
            $razorpay_signature = $request->razorpay_signature;

            $generated_signature = hash_hmac('sha256', $order_id . "|" . $razorpay_payment_id, $this->keySecret);

            if ($generated_signature == $razorpay_signature) {
                $amount = session()->get('razorpay_price') / 100;
                $currency = session()->get('razorpay_currency');

                if (config('payment.referral.enabled') == 'on') {
                    if (config('payment.referral.payment.policy') == 'first') {
                        if (Payment::where('user_id', auth()->user()->id)->where('status', 'completed')->exists()) {
                            /** User already has at least 1 payment and referrer already received credit for it */
                        } else {
                            event(new PaymentReferrerBonus(auth()->user(), $order_id, $amount, 'Razorpay'));
                        }
                    } else {
                        event(new PaymentReferrerBonus(auth()->user(), $order_id, $amount, 'Razorpay'));
                    }
                } 

                if ($type == 'lifetime') {

                    $subscription_id = Str::random(10);
                    $days = 18250;
    
                    $subscription = Subscriber::create([
                        'user_id' => auth()->user()->id,
                        'plan_id' => $plan->id,
                        'status' => 'Active',
                        'created_at' => now(),
                        'gateway' => 'Razorpay',
                        'frequency' => 'lifetime',
                        'plan_name' => $plan->plan_name,
                        'words' => $plan->words,
                        'images' => $plan->images,
                        'characters' => $plan->characters,
                        'minutes' => $plan->minutes,
                        'subscription_id' => $subscription_id,
                        'active_until' => Carbon::now()->addDays($days),
                    ]);  
                }

                $record_payment = new Payment();
                $record_payment->user_id = auth()->user()->id;
                $record_payment->order_id = $order_id;
                $record_payment->plan_id = $plan->id;
                $record_payment->plan_name = $plan->plan_name;
                $record_payment->price = $amount;
                $record_payment->currency = $currency;
                $record_payment->gateway = 'Razorpay';
                $record_payment->frequency = $type;
                $record_payment->status = 'completed';
                $record_payment->words = $plan->words;
                $record_payment->images = $plan->images;
                $record_payment->characters = $plan->characters;
                $record_payment->minutes = $plan->minutes;
                $record_payment->save();
                
                $user = User::where('id',auth()->user()->id)->first();

                if ($type == 'lifetime') {
                    $group = (auth()->user()->hasRole('admin'))? 'admin' : 'subscriber';
                    $user->syncRoles($group);    
                    $user->group = $group;
                    $user->plan_id = $plan->id;
                    $user->total_words = $plan->words;
                    $user->total_images = $plan->images;
                    $user->total_chars = $plan->characters;
                    $user->total_minutes = $plan->minutes;
                    $user->available_words = $plan->words;
                    $user->available_images = $plan->images;
                    $user->available_chars = $plan->characters;
                    $user->available_minutes = $plan->minutes;
                    $user->member_limit = $plan->team_members;
                } else {
                    $user->available_words_prepaid = $user->available_words_prepaid + $plan->words;
                    $user->available_images_prepaid = $user->available_images_prepaid + $plan->images;
                    $user->available_chars_prepaid = $user->available_chars_prepaid + $plan->characters;
                    $user->available_minutes_prepaid = $user->available_minutes_prepaid + $plan->minutes;
                }

                $user->save();       

                event(new PaymentProcessed(auth()->user()));

                return view('user.plans.success', compact('plan', 'order_id'));

            } else {
                toastr()->error(__('Your payment failed the authorization, please try again or contact your bank'));
                return redirect()->back();
            }
            
        }

        toastr()->error(__('Payment was not successful, please try again'));
        return redirect()->back();
    }


    public function createOrder($value, $currency)
    {
        return $this->makeRequest(
            'POST',
            '/v1/orders',
            [],
            [           
                'amount' => $value, 
                'currency' => $currency,
            ],            
            [],
            $isJSONRequest = true,
        );
    }



    public function createSubscription(SubscriptionPlan $id, $user_email, $value)
    {
        return $this->makeRequest(
            'POST',
            '/v1/subscriptions',
            [],
            [           
                'plan_id' => $id->razorpay_gateway_plan_id,
                'total_count' => 24,
                'quantity' => 1,
                'customer_notify' => 1,
            ],            
            [],
            $isJSONRequest = true,
        );

    }


    public function stopSubscription($subscriptionID)
    {
        return $this->makeRequest(
            'POST',
            '/v1/subscriptions/'. $subscriptionID . '/cancel',
            [],
            [   
                'cancel_at_cycle_end' => 0,
            ],            
            [],
            $isJSONRequest = true,
        );
    }


    public function validateSubscriptions(Request $request)
    {
        $razorpay_payment_id = $request->razorpay_payment_id;
        $razorpay_signature = $request->razorpay_signature;
        $order_id = session()->get('subscriptionID');

        $generated_signature = hash_hmac('sha256', $razorpay_payment_id . "|" . $order_id, $this->keySecret);

        if ($generated_signature == $razorpay_signature) {
            
            session()->forget('subscriptionID');

            return true;            
        }

        return false;
    }

}