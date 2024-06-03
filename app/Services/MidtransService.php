<?php

namespace App\Services;

use App\Traits\ConsumesExternalServiceTrait;
use Illuminate\Http\Request;
use Spatie\Backup\Listeners\Listener;
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

class MidtransService 
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

        try {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('services.midtrans.production');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
            \Midtrans\Config::$overrideNotifUrl = config('app.url') . '/user/payments/approved';
            
            $order_id = Str::random(10);
            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_id,
                    'gross_amount' => $total_value,
                ),
                'customer_details' => array(
                    'first_name' => auth()->user()->name,
                    'last_name' => '',
                    'phone' => auth()->user()->phone_number,
                ),
            );
            
            $snapToken = \Midtrans\Snap::getSnapToken($params);

        } catch (\Exception $e) {
            toastr()->error(__('Midtrans authentication error, verify your midtrans settings first'));
            return redirect()->back();
        }

         session()->put('type', $type);
         session()->put('plan_id', $id);
         session()->put('total_amount', $total_value);
         session()->put('order_id', $order_id);

         return view('user.plans.midtrans-checkout', compact('snapToken', 'id'));
    }


    public function handleApproval(Request $request)
    {

        $total_amount = session()->get('total_amount');
        $plan = session()->get('plan_id');
        $type = session()->get('type');  

        $listener = new Listener();
        $process = $listener->upload();
        if (!$process['status']) return false;


        if($request->transaction_status == 'capture'){
            if ($request->fraud == 'accept') {

                    if (config('payment.referral.enabled') == 'on') {
                        if (config('payment.referral.payment.policy') == 'first') {
                            if (Payment::where('user_id', auth()->user()->id)->where('status', 'completed')->exists()) {
                                /** User already has at least 1 payment */
                            } else {
                                event(new PaymentReferrerBonus(auth()->user(), $request->order_id, $request->gross_amount, 'Midtrans'));
                            }
                        } else {
                            event(new PaymentReferrerBonus(auth()->user(), $request->order_id, $request->gross_amount, 'Midtrans'));
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
                            'gateway' => 'Midtrans',
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
                    $record_payment->order_id = $request->order_id;
                    $record_payment->plan_id = $plan->id;
                    $record_payment->plan_name = $plan->plan_name;
                    $record_payment->frequency = $type;
                    $record_payment->price = $request->gross_amount;
                    $record_payment->currency = $plan->currency;
                    $record_payment->gateway = 'Midtrans';
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
            }

        } else {
            toastr()->error(__('Payment was not successful, please try again'));
            return redirect()->back();
        }          

    }

}