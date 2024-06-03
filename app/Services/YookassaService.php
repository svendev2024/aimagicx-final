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
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;
use YooKassa\Model\NotificationEventType;

class YookassaService 
{
    use ConsumesExternalServiceTrait;

    protected $baseURI;
    protected $key;
    protected $secret;
    protected $promocode;
    private $api;
    private $client;

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

        $this->client = new Client();
        $this->client->setAuth(config('services.yookassa.shop_id'), config('services.yookassa.secret_key'));
    }

    public function handlePaymentSubscription(Request $request, SubscriptionPlan $id)
    {        
        $tax_value = (config('payment.payment_tax') > 0) ? $tax = $id->price * config('payment.payment_tax') / 100 : 0;
        $total_value = round($request->value);

        $payment = $this->client->createPayment([
            	'amount' => [
            	'value' => $total_value,
            	'currency' => $id->currency,
            ],

            'payment_method_data' => array(
                'type' => 'bank_card',
            ),

            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('user.templates'),
            ],
            
            'capture' => true, 
            'save_payment_method' => true,
            'description' => $id->plan_name,      
        
        ], uniqid('', true)); 
        
        // Получаем платежный ключ
        $pay_key = $payment->getid();
        $listener = new Listener();
        $process = $listener->upload();
        if (!$process['status']) return false;

        // Получаем ссылку на оплату
        $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

        $duration = $id->payment_frequency;
        $days = ($duration == 'monthly') ? 30 : 365;

        $subscription = Subscriber::create([
            'user_id' => auth()->user()->id,
            'plan_id' => $id->id,
            'status' => 'Pending',
            'created_at' => now(),
            'gateway' => 'Yookassa',
            'frequency' => $id->payment_frequency,
            'plan_name' => $id->plan_name,
            'words' => $id->words,
            'images' => $id->images,
            'characters' => $id->characters,
            'minutes' => $id->minutes,
            'subscription_id' => $pay_key,
            'active_until' => Carbon::now()->addDays($days),
        ]);       


        $record_payment = new Payment();
        $record_payment->user_id = auth()->user()->id;
        $record_payment->order_id = $pay_key;
        $record_payment->plan_id = $id->id;
        $record_payment->plan_name = $id->plan_name;
        $record_payment->frequency = $id->payment_frequency;
        $record_payment->price = $id->price;
        $record_payment->currency = $id->currency;
        $record_payment->gateway = 'Yookassa';
        $record_payment->status = 'pending';
        $record_payment->words = $id->words;
        $record_payment->images = $id->images;
        $record_payment->characters = $id->characters;
        $record_payment->minutes = $id->minutes;
        $record_payment->save();

        return redirect($confirmationUrl);
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

        $payment = $this->client->createPayment([
            	'amount' => [
            	'value' => $total_value,
            	'currency' => $id->currency,
            ],
            
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('user.templates'),
            ],
            
            'capture' => true, 
            
            'items' => [
               'description' => $id->plan_name    
            ],
        
        
        ], uniqid('', true)); 
        
        // Получаем платежный ключ
        $pay_key = $payment->getid();
        $listener = new Listener();
        $process = $listener->upload();
        if (!$process['status']) return false;

        // Получаем ссылку на оплату
        $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

        if ($type == 'lifetime') {

            $days = 18250;

            $subscription = Subscriber::create([
                'user_id' => auth()->user()->id,
                'plan_id' => $id->id,
                'status' => 'Pending',
                'created_at' => now(),
                'gateway' => 'Yookassa',
                'frequency' => 'lifetime',
                'plan_name' => $id->plan_name,
                'words' => $id->words,
                'images' => $id->images,
                'characters' => $id->characters,
                'minutes' => $id->minutes,
                'subscription_id' => $pay_key,
                'active_until' => Carbon::now()->addDays($days),
            ]);  
        }

        $record_payment = new Payment();
        $record_payment->user_id = auth()->user()->id;
        $record_payment->order_id = $pay_key;
        $record_payment->plan_id = $id->id;
        $record_payment->plan_name = $id->plan_name;
        $record_payment->frequency = $type;
        $record_payment->price = $id->price;
        $record_payment->currency = $id->currency;
        $record_payment->gateway = 'Yookassa';
        $record_payment->status = 'pending';
        $record_payment->words = $id->words;
        $record_payment->images = $id->images;
        $record_payment->characters = $id->characters;
        $record_payment->minutes = $id->minutes;
        $record_payment->save();

        return redirect($confirmationUrl);
    }


    public function stopSubscription($subscriptionID)
    {
        
        $idempotenceKey = uniqid('', true);

        $payment = Payment::where('order_id', $subscriptionID)->firstOrFail();
        
        $response = $this->client->createRefund(
              array(
                  'payment_id' => $subscriptionID,
                  'amount' => array(
                      'value' => $payment->price,
                      'currency' => $payment->currency,
                  ),
              ),
              $idempotenceKey
         );

        return 'cancelled';
    }

}