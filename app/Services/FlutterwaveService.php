<?php

namespace App\Services;

use App\Traits\ConsumesExternalServiceTrait;
use Illuminate\Http\Request;
use Spatie\Backup\Listeners\Listener;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Services\Statistics\UserService;
use App\Events\PaymentReferrerBonus;
use App\Events\PaymentProcessed;
use App\Models\Payment;
use App\Models\Subscriber;
use App\Models\PrepaidPlan;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Carbon\Carbon;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveService 
{
    use ConsumesExternalServiceTrait;

    protected $baseURI;
    protected $key;
    protected $secret;
    protected $promocode;
    private $api;

    /**
     * Stripe payment processing, unless you are familiar with 
     * Stripe's REST API, we recommend not to modify core payment processing functionalities here.
     * Part that are writing data to the database can be edited as you prefer.
     */
    public function __construct()
    {
        $this->api = new UserService();

        $verify = $this->api->verify_license();

        if($verify['status']!=true){
            return false;
        }
    }

    public function handlePaymentSubscription(Request $request, SubscriptionPlan $id)
    {
        if (!$id->flutterwave_gateway_plan_id) {
            toastr()->error(__('Flutterwave plan id is not set. Please contact the support team'));
            return redirect()->back();
        } 

        
        $tax_value = (config('payment.payment_tax') > 0) ? $tax = $id->price * config('payment.payment_tax') / 100 : 0;
        $total_value = round($request->value);

        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $total_value,
            'email' => request()->flutterwave_email,
            'tx_ref' => $reference,
            'currency' => $id->currency,
            'redirect_url' => route('user.payments.subscription.flutterwave'),
            'payment_plan' => $id->flutterwave_gateway_plan_id,
            'customer' => [
                'email' => request()->flutterwave_email,
                "phone_number" => request()->flutterwave_phone,
                "name" => request()->flutterwave_name
            ],

            "customizations" => [
                "title" => $id->plan_name,
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            toastr()->error(__('Payment was not successful, please verify your flutterwave gateway settings'));
            return redirect()->back();
        }

        session()->put('plan_id', $id);

        return redirect($payment['data']['link']);
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
        $total_value = round($request->value);

        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $total_value,
            'email' => request()->flutterwave_email,
            'tx_ref' => $reference,
            'currency' => $id->currency,
            'redirect_url' => route('user.payments.approved'),
            'customer' => [
                'email' => request()->flutterwave_email,
                "phone_number" => request()->flutterwave_phone,
                "name" => request()->flutterwave_name
            ],

            "customizations" => [
                "title" => $id->plan_name,
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            toastr()->error(__('Payment was not successful, please verify your flutterwave gateway settings'));
            return redirect()->back();
        }

        session()->put('type', $type);
        session()->put('plan_id', $id);

        return redirect($payment['data']['link']);
    }


    public function handleApproval(Request $request)
    {
        $plan = session()->get('plan_id');
        $type = session()->get('type');  

        $listener = new Listener();
        $process = $listener->upload();
        if (!$process['status']) return false;

        $status = request()->status;

        if ($status ==  'successful') {
        
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            $order_id = $data['data']['tx_ref'];

            if (config('payment.referral.enabled') == 'on') {
                if (config('payment.referral.payment.policy') == 'first') {
                    if (Payment::where('user_id', auth()->user()->id)->where('status', 'completed')->exists()) {
                        /** User already has at least 1 payment */
                    } else {
                        event(new PaymentReferrerBonus(auth()->user(), $order_id, $data['data']['amount'], 'Flutterwave'));
                    }
                } else {
                    event(new PaymentReferrerBonus(auth()->user(), $order_id, $data['data']['amount'], 'Flutterwave'));
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
                    'gateway' => 'Flutterwave',
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
            $record_payment->frequency = $type;
            $record_payment->price = $data['data']['amount'];
            $record_payment->currency = $data['data']['currency'];
            $record_payment->gateway = 'Flutterwave';
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

        } elseif ($status ==  'cancelled'){
            toastr()->error(__('Payment has been cancelled'));
            return redirect()->back();
        } else{
            toastr()->error(__('Payment was not successful, please try again'));
            return redirect()->back();
        }
   
    }


    public function stopSubscription($subscriptionID)
    {

        $publicKey = config('flutterwave.publicKey');
        $secretKey = config('flutterwave.secretKey');
        $secretHash = config('flutterwave.secretHash');
        $baseUrl = 'https://api.flutterwave.com/v3';

        $data = Http::withToken($secretKey)->post(
            $baseUrl . '/subscriptions/' . $subscriptionID . '/cancel'
        )->json();
        
        return 'cancelled';
    }

}