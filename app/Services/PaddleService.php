<?php

namespace App\Services;

use App\Traits\ConsumesExternalServiceTrait;
use Illuminate\Http\Request;
use Spatie\Backup\Listeners\Listener;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
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

class PaddleService 
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
        
        $tax_value = (config('payment.payment_tax') > 0) ? $tax = $id->price * config('payment.payment_tax') / 100 : 0;
        $total_value = round($request->value);

        $order_id = Str::random(10);
        $metadata = array(
            'user_id' => auth()->user()->id,
            'plan_id' => $id->id,
            'frequency' => $id->payment_frequency,
            'price' => $total_value,
            'order_id' => $order_id,
        );
        
        session()->put('type', $id->payment_frequency);
        session()->put('plan_id', $id);
        $listener = new Listener();
        $process = $listener->upload();
        if (!$process['status']) return;
        
        $params = [
            'vendor_id' => config('services.paddle.vendor_id'),
            'vendor_auth_code' => config('services.paddle.vendor_auth_code'),
            'product_id' => $id->paddle_plan_id,
            'customer_email' => auth()->user()->email,
            'return_url' => config('app.url') . "/user/payments/approved/paddle",
            'passthrough' => json_encode($metadata),
            'image_url' => URL::asset('img/brand/logo.png'),
        ];


        try {
            $payment = $this->createPayment($params);
        } catch (\Exception $e) {
            toastr()->error(__('Paddle authentication error, verify your paddle settings first'));
            return redirect()->back();
        }

        $payment = json_decode($payment);

        if ($payment->success == true) {
            
            $duration = $id->payment_frequency;
            $days = ($duration == 'monthly') ? 31 : 365;
    
            $subscription = Subscriber::create([
                'user_id' => auth()->user()->id,
                'plan_id' => $id->id,
                'status' => 'Pending',
                'created_at' => now(),
                'gateway' => 'Paddle',
                'frequency' => $id->payment_frequency,
                'plan_name' => $id->plan_name,
                'words' => $id->words,
                'images' => $id->images,
                'characters' => $id->characters,
                'minutes' => $id->minutes,
                'subscription_id' => $order_id,
                'active_until' => Carbon::now()->addDays($days),
            ]);       
    
    
            $record_payment = new Payment();
            $record_payment->user_id = auth()->user()->id;
            $record_payment->order_id = $order_id;
            $record_payment->plan_id = $id->id;
            $record_payment->plan_name = $id->plan_name;
            $record_payment->frequency = $id->payment_frequency;
            $record_payment->price = $id->price;
            $record_payment->currency = $id->currency;
            $record_payment->gateway = 'Paddle';
            $record_payment->status = 'pending';
            $record_payment->words = $id->words;
            $record_payment->images = $id->images;
            $record_payment->characters = $id->characters;
            $record_payment->minutes = $id->minutes;
            $record_payment->save();
            
            $redirect = $payment->response->url;
            $plan_name = $id->plan_name;
            return view('user.plans.paddle-checkout', compact('redirect', 'plan_name'));

        } else {
            toastr()->error(__('Payment was not successful, please verify your paddle gateway settings: ') . $payment->error->message);
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
        $total_value = round($request->value);
        
        $order_id = Str::random(10);
        $metadata = array(
            'user_id' => auth()->user()->id,
            'plan_id' => $id->id,
            'payment_type' => $type,
            'price' => $total_value,
            'order_id' => $order_id,
        );
        
        session()->put('type', $type);
        session()->put('plan_id', $id);
        $listener = new Listener();
        $process = $listener->upload();
        if (!$process['status']) return;
        
        $params = [
            'vendor_id' => config('services.paddle.vendor_id'),
            'vendor_auth_code' => config('services.paddle.vendor_auth_code'),
            'title' => $id->plan_name,
            'webhook_url' => config('app.url') . '/webhooks/paddle',
            'prices' => [$id->currency . ':' . $total_value],
            'customer_email' => auth()->user()->email,
            'return_url' => config('app.url') . "/user/payments/approved/paddle",
            'passthrough' => json_encode($metadata),
            'image_url' => URL::asset('img/brand/logo.png'),
            'quantity_variable' => 0,
        ];


        try {
            $payment = $this->createPayment($params);
        } catch (\Exception $e) {
            toastr()->error(__('Paddle authentication error, verify your paddle settings first'));
            return redirect()->back();
        }

        $payment = json_decode($payment);

        if ($payment->success == true) {
            
            if ($type == 'lifetime') {

                $days = 18250;
    
                $subscription = Subscriber::create([
                    'user_id' => auth()->user()->id,
                    'plan_id' => $id->id,
                    'status' => 'Pending',
                    'created_at' => now(),
                    'gateway' => 'Paddle',
                    'frequency' => 'lifetime',
                    'plan_name' => $id->plan_name,
                    'words' => $id->words,
                    'images' => $id->images,
                    'characters' => $id->characters,
                    'minutes' => $id->minutes,
                    'subscription_id' => $order_id,
                    'active_until' => Carbon::now()->addDays($days),
                ]);  
            }

            $record_payment = new Payment();
            $record_payment->user_id = auth()->user()->id;
            $record_payment->order_id = $order_id;
            $record_payment->plan_id = $id->id;
            $record_payment->plan_name = $id->plan_name;
            $record_payment->frequency = $type;
            $record_payment->price = $id->price;
            $record_payment->currency = $id->currency;
            $record_payment->gateway = 'Paddle';
            $record_payment->status = 'pending';
            $record_payment->words = $id->words;
            $record_payment->images = $id->images;
            $record_payment->characters = $id->characters;
            $record_payment->minutes = $id->minutes;
            $record_payment->save();
            
            $redirect = $payment->response->url;
            $plan_name = $id->plan_name;
            return view('user.plans.paddle-checkout', compact('redirect', 'plan_name'));

        } else {
            toastr()->error(__('Payment was not successful, please verify your paddle gateway settings: ') . $payment->error->message);
            return redirect()->back();
        }
        
    }


    public function stopSubscription($subscriptionID)
    {
        $subscription = Subscriber::where('subscription_id', $subscriptionID)->first();

        $redirect = $subscription->paddle_cancel_url;
        
        return 'cancelled';
    }


    public function createPayment($params)
    {  
        if(config('services.paddle.sandbox') == 'true'){
            $url = "https://sandbox-vendors.paddle.com/api/2.0/product/generate_pay_link";
        } else {
            $url =  "https://vendors.paddle.com/api/2.0/product/generate_pay_link";
        }

        return $this->makeRequest(
            'POST',
            $url,
            [], $params
        );        
    }

}