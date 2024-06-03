<?php

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\Backup\Listeners\Listener;
use Illuminate\Support\Str;
use App\Services\Statistics\UserService;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\BadResponseException;
use App\Events\PaymentProcessed;
use App\Models\Payment;
use App\Models\Subscriber;
use App\Models\PrepaidPlan;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Carbon\Carbon;


class CoinbaseService 
{

    protected $client;
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

        $this->client = new HttpClient();     
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

        $listener = new Listener();
        $process = $listener->upload();
        if (!$process['status']) return false;
        
        try {
            $coinbase_request = $this->client->request('POST', 'https://api.commerce.coinbase.com/charges', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-CC-Api-Key' => config('services.coinbase.api_key'),
                        'X-CC-Version' => '2018-03-22',
                    ],
                    'body' => json_encode(array_merge_recursive([
                        'name' => 'Plan Name: '. $id->plan_name,
                        'description' => 'Included Characters: '. number_format($id->characters) . '; Included Minutes: ' . number_format($id->minutes),
                        'local_price' => [
                            'amount' => $total_value,
                            'currency' => $request->currency,
                        ],
                        'pricing_type' => 'fixed_price',
                        'metadata' => [
                            'user' => $request->user()->id,
                            'plan_id' => $id->id,
                            'type' => $type,
                            'amount' => $total_value,
                            'currency' => $request->currency,
                        ],
                        'redirect_url' => route('user.payments.approved'),
                        'cancel_url' => route('user.payments.cancelled'),
                    ]))
                ]
            );


            $coinbase = json_decode($coinbase_request->getBody()->getContents());

            $this->recordPayment($coinbase->data->code, $id, $total_value, $request->currency, $type);

            session()->put('order_coinbase', $coinbase->data->code);
            session()->put('plan_coinbase', $id);
            session()->put('type', $type);
          
        } catch (BadResponseException $e) {
            return back()->with('error', 'Coinbase authentication error.' . $e->getResponse()->getBody()->getContents());
        }

        return redirect($coinbase->data->hosted_url);
    }


    public function recordPayment($payment_id, $plan, $amount, $currency, $type)
    {        
        if ($type == 'lifetime') {

            $days = 18250;

            $subscription = Subscriber::create([
                'user_id' => auth()->user()->id,
                'plan_id' => $plan->id,
                'status' => 'Pending',
                'created_at' => now(),
                'gateway' => 'Coinbase',
                'frequency' => 'lifetime',
                'plan_name' => $plan->plan_name,
                'words' => $plan->words,
                'images' => $plan->images,
                'characters' => $plan->characters,
                'minutes' => $plan->minutes,
                'subscription_id' => $payment_id,
                'active_until' => Carbon::now()->addDays($days),
            ]);  
        }

        $record_payment = new Payment();
        $record_payment->user_id = auth()->user()->id;
        $record_payment->order_id = $payment_id;
        $record_payment->plan_id = $plan->id;
        $record_payment->plan_name = $plan->plan_name;
        $record_payment->frequency = $type;
        $record_payment->price = $amount;
        $record_payment->currency = $currency;
        $record_payment->gateway = 'Coinbase';
        $record_payment->status = 'pending';
        $record_payment->words = $plan->words;
        $record_payment->images = $plan->images;
        $record_payment->characters = $plan->characters;
        $record_payment->minutes = $plan->minutes;
        $record_payment->save();
    }


    public function handleApproval()
    {
        $order_id = session()->get('order_coinbase');
        $plan = session()->get('plan_coinbase');

        return view('user.plans.success', compact('plan', 'order_id'));
    }

}