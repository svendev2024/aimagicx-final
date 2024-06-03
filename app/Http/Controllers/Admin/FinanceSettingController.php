<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentPlatform;
use App\Models\Setting;


class FinanceSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank_information = ['bank_instructions', 'bank_requisites'];
        $bank = [];
        $settings = Setting::all();

        foreach ($settings as $row) {
            if (in_array($row['name'], $bank_information)) {
                $bank[$row['name']] = $row['value'];
            }
        }
        
        return view('admin.finance.settings.index', compact('bank'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        request()->validate([
            'tax' => 'required',
            'currency' => 'required',

            'enable-paypal' => 'sometimes|required',
            'paypal_client_id' => 'required_if:enable-paypal,on',
            'paypal_client_secret' => 'required_if:enable-paypal,on',
            'paypal_base_uri' => 'required_if:enable-paypal,on',

            'enable-paypal-subscription' => 'sometimes|required',
            'paypal_webhook_uri' => 'required_if:enable-paypal-subscription,on',
            'paypal_webhook_id' => 'required_if:enable-paypal-subscription,on',

            'enable-stripe' => 'sometimes|required',
            'stripe_key' => 'required_if:enable-stripe,on',
            'stripe_secret_key' => 'required_if:enable-stripe,on',
            'stripe_base_uri' => 'required_if:enable-stripe,on',            

            'enable-stripe-subscription' => 'sometimes|required',
            'stripe_webhook_uri' => 'required_if:enable-stripe-subscription,on',
            'stripe_webhook_secret' => 'required_if:enable-stripe-subscription,on',

            'enable-bank' => 'sometimes|required',
            'bank_instructions' => 'required_if:enable-bank,on',
            'bank_requisites' => 'required_if:enable-bank-prepaid,on',

            'enable-bank-subscription' => 'sometimes|required',
            'bank_instructions' => 'required_if:enable-bank-subscription,on',
            'bank_requisites' => 'required_if:enable-bank-subscription,on',

            'enable-paystack' => 'sometimes|required',
            'paystack_secret_key' => 'required_if:enable-paystack,on',
            'paystack_public_key' => 'required_if:enable-paystack,on',
            'paystack_base_uri' => 'required_if:enable-paystack,on',

            'enable-paystack-subscription' => 'sometimes|required',
            'paystack_secret_key' => 'required_if:enable-paystack-subscription,on',
            'paystack_webhook_uri' => 'required_if:enable-paystack-subscription,on',

            'enable-razorpay' => 'sometimes|required',
            'razorpay_key_id' => 'required_if:enable-razorpay,on',
            'razorpay_key_secret' => 'required_if:enable-razorpay,on',
            'razorpay_base_uri' => 'required_if:enable-razorpay,on',

            'enable-razorpay-subscription' => 'sometimes|required',
            'razorpay_webhook_secret' => 'required_if:enable-razorpay-subscription,on',
            'razorpay_webhook_uri' => 'required_if:enable-razorpay-subscription,on',

            'enable-mollie' => 'sometimes|required',
            'mollie_key_id' => 'required_if:enable-mollie,on',
            'mollie_base_uri' => 'required_if:enable-mollie,on',
            'mollie_webhook_uri' => 'required_if:enable-mollie,on',

            'enable-mollie-subscription' => 'sometimes|required',
            'mollie_key_id' => 'required_if:enable-mollie-subscription,on',
            'mollie_base_uri' => 'required_if:enable-mollie-subscription,on',
            'mollie_webhook_uri' => 'required_if:enable-mollie-subscription,on',

            'enable-braintree' => 'sometimes|required',
            'braintree_env' => 'required_if:enable-braintree,on',
            'braintree_merchant_id' => 'required_if:enable-braintree,on',
            'braintree_private_key' => 'required_if:enable-braintree,on',
            'braintree_public_key' => 'required_if:enable-braintree,on',

            'enable-coinbase' => 'sometimes|required',
            'coinbase_api_key' => 'required_if:enable-coinbase,on',
            'coinbase_webhook_uri' => 'required_if:enable-coinbase,on',
            'coinbase_webhook_secret' => 'required_if:enable-coinbase,on',

            'enable-midtrans' => 'sometimes|required',
            'midtrans_server_key' => 'required_if:enable-midtrans,on',
            'midtrans_client_key' => 'required_if:enable-midtrans,on',
            'midtrans_merchant_id' => 'required_if:enable-midtrans,on',
            'midtrans-production' => 'required_if:enable-midtrans,on',

            'enable-flutterwave' => 'sometimes|required',
            'flutterwave_public_key' => 'required_if:enable-flutterwave,on',
            'flutterwave_secret_key' => 'required_if:enable-flutterwave,on',

            'enable-flutterwave-subscription' => 'sometimes|required',
            'flutterwave_webhook_url' => 'required_if:enable-flutterwave-subscription,on',
            'flutterwave_secret_hash' => 'required_if:enable-flutterwave-subscription,on',

            'enable-yookassa' => 'sometimes|required',
            'yookassa_shop_id' => 'required_if:enable-yookassa,on',
            'yookassa_secret_key' => 'required_if:enable-yookassa,on',

            'enable-yookassa-subscription' => 'sometimes|required',
            'yookassa_http_uri' => 'required_if:enable-yookassa-subscription,on',

            'enable-paddle' => 'sometimes|required',
            'paddle_vendor_id' => 'required_if:enable-paddle,on',
            'paddle_vendor_auth_code' => 'required_if:enable-paddle,on',

            'enable-paddle-subscription' => 'sometimes|required',
            'paddle_vendor_id' => 'required_if:enable-paddle-subscription,on',
            'paddle_vendor_auth_code' => 'required_if:enable-paddle-subscription,on',
        ]);
       

        $this->storeConfiguration('PAYMENT_TAX', request('tax'));       
        $this->storeConfiguration('DEFAULT_SYSTEM_CURRENCY', request('currency'));     
        $this->storeConfiguration('DECIMAL_POINTS', request('decimal-points'));     
     
        if (request('currency')) {
            $newName = "'" . config('currencies.all.' . request('currency') . '.symbol') . "'";
            $this->storeWithQuotes('DEFAULT_SYSTEM_CURRENCY_SYMBOL', $newName);
        }  
        
        $this->storeConfiguration('STRIPE_ENABLED', request('enable-stripe'));
        $this->storeConfiguration('STRIPE_SUBSCRIPTION_ENABLED', request('enable-stripe-subscription'));
        $this->storeConfiguration('STRIPE_KEY', request('stripe_key'));
        $this->storeConfiguration('STRIPE_SECRET', request('stripe_secret_key'));  
        $this->storeConfiguration('STRIPE_BASE_URI', request('stripe_base_uri'));  
        $this->storeConfiguration('STRIPE_WEBHOOK_URI', request('stripe_webhook_uri'));  
        $this->storeConfiguration('STRIPE_WEBHOOK_SECRET', request('stripe_webhook_secret'));  

        $this->storeConfiguration('PAYPAL_ENABLED', request('enable-paypal'));
        $this->storeConfiguration('PAYPAL_SUBSCRIPTION_ENABLED', request('enable-paypal-subscription'));
        $this->storeConfiguration('PAYPAL_CLIENT_ID', request('paypal_client_id'));      
        $this->storeConfiguration('PAYPAL_CLIENT_SECRET', request('paypal_client_secret'));  
        $this->storeConfiguration('PAYPAL_BASE_URI', request('paypal_base_uri'));  
        $this->storeConfiguration('PAYPAL_WEBHOOK_URI', request('paypal_webhook_uri'));  
        $this->storeConfiguration('PAYPAL_WEBHOOK_ID', request('paypal_webhook_id'));  

        $this->storeConfiguration('PAYSTACK_ENABLED', request('enable-paystack'));
        $this->storeConfiguration('PAYSTACK_SUBSCRIPTION_ENABLED', request('enable-paystack-subscription'));
        $this->storeConfiguration('PAYSTACK_SECRET_KEY', request('paystack_secret_key'));
        $this->storeConfiguration('PAYSTACK_PUBLIC_KEY', request('paystack_public_key'));  
        $this->storeConfiguration('PAYSTACK_BASE_URI', request('paystack_base_uri'));  
        $this->storeConfiguration('PAYSTACK_WEBHOOK_URI', request('paystack_webhook_uri'));   

        $this->storeConfiguration('RAZORPAY_ENABLED', request('enable-razorpay'));
        $this->storeConfiguration('RAZORPAY_SUBSCRIPTION_ENABLED', request('enable-razorpay-subscription'));
        $this->storeConfiguration('RAZORPAY_KEY_ID', request('razorpay_key_id'));
        $this->storeConfiguration('RAZORPAY_KEY_SECRET', request('razorpay_key_secret'));  
        $this->storeConfiguration('RAZORPAY_BASE_URI', request('razorpay_base_uri'));  
        $this->storeConfiguration('RAZORPAY_WEBHOOK_URI', request('razorpay_webhook_uri'));  
        $this->storeConfiguration('RAZORPAY_WEBHOOK_SECRET', request('razorpay_webhook_secret'));  

        $this->storeConfiguration('MOLLIE_ENABLED', request('enable-mollie'));
        $this->storeConfiguration('MOLLIE_SUBSCRIPTION_ENABLED', request('enable-mollie-subscription'));
        $this->storeConfiguration('MOLLIE_KEY_ID', request('mollie_key_id'));
        $this->storeConfiguration('MOLLIE_BASE_URI', request('mollie_base_uri'));
        $this->storeConfiguration('MOLLIE_WEBHOOK_URI', request('mollie_webhook_uri'));

        $this->storeConfiguration('BRAINTREE_ENABLED', request('enable-braintree'));
        $this->storeConfiguration('BRAINTREE_PRIVATE_KEY', request('braintree_private_key'));
        $this->storeConfiguration('BRAINTREE_PUBLIC_KEY', request('braintree_public_key'));  
        $this->storeConfiguration('BRAINTREE_MERCHANT_ID', request('braintree_merchant_id'));  
        $this->storeConfiguration('BRAINTREE_ENV', request('braintree_env')); 

        $this->storeConfiguration('COINBASE_ENABLED', request('enable-coinbase'));
        $this->storeConfiguration('COINBASE_API_KEY', request('coinbase_api_key'));  
        $this->storeConfiguration('COINBASE_WEBHOOK_URI', request('coinbase_webhook_uri'));  
        $this->storeConfiguration('COINBASE_WEBHOOK_SECRET', request('coinbase_webhook_secret')); 

        $this->storeConfiguration('BANK_TRANSFER_ENABLED', request('enable-bank'));
        $this->storeConfiguration('BANK_TRANSFER_SUBSCRIPTION', request('enable-bank-subscription')); 
        
        $this->storeConfiguration('MIDTRANS_ENABLED', request('enable-midtrans'));
        $this->storeConfiguration('MIDTRANS_SERVER_KEY', request('midtrans_server_key'));
        $this->storeConfiguration('MIDTRANS_CLIENT_KEY', request('midtrans_client_key'));  
        $this->storeConfiguration('MIDTRANS_MERCHANT_ID', request('midtrans_merchant_id'));  
        $this->storeConfiguration('MIDTRANS_PRODUCTION', request('midtrans-production')); 

        $this->storeConfiguration('FLUTTERWAVE_ENABLED', request('enable-flutterwave'));
        $this->storeConfiguration('FLUTTERWAVE_SUBSCRIPTION_ENABLED', request('enable-flutterwave-subscription'));
        $this->storeConfiguration('FLUTTERWAVE_PUBLIC_KEY', request('flutterwave_public_key'));
        $this->storeConfiguration('FLUTTERWAVE_SECRET_KEY', request('flutterwave_secret_key'));  
        $this->storeConfiguration('FLUTTERWAVE_WEBHOOK_URL', request('flutterwave_webhook_url'));  
        $this->storeConfiguration('FLUTTERWAVE_SECRET_HASH', request('flutterwave_secret_hash')); 

        $this->storeConfiguration('YOOKASSA_ENABLED', request('enable-yookassa'));
        $this->storeConfiguration('YOOKASSA_SUBSCRIPTION_ENABLED', request('enable-yookassa-subscription'));
        $this->storeConfiguration('YOOKASSA_SHOP_ID', request('yookassa_shop_id'));
        $this->storeConfiguration('YOOKASSA_SECRET_KEY', request('yookassa_secret_key'));
        $this->storeConfiguration('YOOKASSA_HTTP_URI', request('yookassa_http_uri'));

        $this->storeConfiguration('PADDLE_ENABLED', request('enable-paddle'));
        $this->storeConfiguration('PADDLE_SUBSCRIPTION_ENABLED', request('enable-paddle-subscription'));
        $this->storeConfiguration('PADDLE_VENDOR_ID', request('paddle_vendor_id'));
        $this->storeConfiguration('PADDLE_VENDOR_AUTH_CODE', request('paddle_vendor_auth_code'));
        $this->storeConfiguration('PADDLE_SANDBOX', request('paddle_sandbox'));
        

        $rows = ['bank_instructions', 'bank_requisites'];
        
        foreach ($rows as $row) {
            Setting::where('name', $row)->update(['value' => $request->input($row)]);
        }
        
       # Enable/Disable Payment Gateways
       if (request('enable-paypal') == 'on') {
        $paypal = PaymentPlatform::where('name', 'PayPal')->first();
        $paypal->enabled = 1;
        $paypal->save();

        } else {
            $paypal = PaymentPlatform::where('name', 'PayPal')->first();
            $paypal->enabled = 0;
            $paypal->save();
        }

        if (request('enable-stripe') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Stripe')->first();
            $stripe->enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Stripe')->first();
            $stripe->enabled = 0;
            $stripe->save();
        }

        if (request('enable-paystack') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Paystack')->first();
            $stripe->enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Paystack')->first();
            $stripe->enabled = 0;
            $stripe->save();
        }

        if (request('enable-razorpay') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Razorpay')->first();
            $stripe->enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Razorpay')->first();
            $stripe->enabled = 0;
            $stripe->save();
        }

        if (request('enable-mollie') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Mollie')->first();
            $stripe->enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Mollie')->first();
            $stripe->enabled = 0;
            $stripe->save();
        }

        if (request('enable-braintree') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Braintree')->first();
            $stripe->enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Braintree')->first();
            $stripe->enabled = 0;
            $stripe->save();
        }

        if (request('enable-coinbase') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Coinbase')->first();
            $stripe->enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Coinbase')->first();
            $stripe->enabled = 0;
            $stripe->save();
        }

        if (request('enable-bank') == 'on') {
            $bank_transfer = PaymentPlatform::where('name', 'BankTransfer')->first();
            $bank_transfer->enabled = 1;
            $bank_transfer->save();

        } else {
            $bank_transfer = PaymentPlatform::where('name', 'BankTransfer')->first();
            $bank_transfer->enabled = 0;
            $bank_transfer->save();
        }

        if (request('enable-midtrans') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Midtrans')->first();
            $stripe->enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Midtrans')->first();
            $stripe->enabled = 0;
            $stripe->save();
        }

        if (request('enable-flutterwave') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Flutterwave')->first();
            $stripe->enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Flutterwave')->first();
            $stripe->enabled = 0;
            $stripe->save();
        }

        if (request('enable-yookassa') == 'on') {
            $yookassa = PaymentPlatform::where('name', 'Yookassa')->first();
            $yookassa->enabled = 1;
            $yookassa->save();
        } else {
            $yookassa = PaymentPlatform::where('name', 'Yookassa')->first();
            $yookassa->enabled = 0;
            $yookassa->save();
        }

        if (request('enable-paddle') == 'on') {
            $yookassa = PaymentPlatform::where('name', 'Paddle')->first();
            $yookassa->enabled = 1;
            $yookassa->save();
        } else {
            $yookassa = PaymentPlatform::where('name', 'Paddle')->first();
            $yookassa->enabled = 0;
            $yookassa->save();
        }

        # Enable/Disable Payment Gateways Subscription
        if (request('enable-paypal-subscription') == 'on') {
            $paypal = PaymentPlatform::where('name', 'PayPal')->first();
            $paypal->subscriptions_enabled = 1;
            $paypal->save();

        } else {
            $paypal = PaymentPlatform::where('name', 'PayPal')->first();
            $paypal->subscriptions_enabled = 0;
            $paypal->save();
        }

        if (request('enable-stripe-subscription') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Stripe')->first();
            $stripe->subscriptions_enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Stripe')->first();
            $stripe->subscriptions_enabled = 0;
            $stripe->save();
        }

        if (request('enable-paystack-subscription') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Paystack')->first();
            $stripe->subscriptions_enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Paystack')->first();
            $stripe->subscriptions_enabled = 0;
            $stripe->save();
        }

        if (request('enable-razorpay-subscription') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Razorpay')->first();
            $stripe->subscriptions_enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Razorpay')->first();
            $stripe->subscriptions_enabled = 0;
            $stripe->save();
        }

        if (request('enable-mollie-subscription') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Mollie')->first();
            $stripe->subscriptions_enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Mollie')->first();
            $stripe->subscriptions_enabled = 0;
            $stripe->save();
        }

        if (request('enable-flutterwave-subscription') == 'on') {
            $stripe = PaymentPlatform::where('name', 'Flutterwave')->first();
            $stripe->subscriptions_enabled = 1;
            $stripe->save();

        } else {
            $stripe = PaymentPlatform::where('name', 'Flutterwave')->first();
            $stripe->subscriptions_enabled = 0;
            $stripe->save();
        }

        if (request('enable-bank-subscription') == 'on') {
            $bank_transfer = PaymentPlatform::where('name', 'BankTransfer')->first();
            $bank_transfer->subscriptions_enabled = 1;
            $bank_transfer->save();

        } else {
            $bank_transfer = PaymentPlatform::where('name', 'BankTransfer')->first();
            $bank_transfer->subscriptions_enabled = 0;
            $bank_transfer->save();
        }

        if (request('enable-yookassa-subscription') == 'on') {
            $yookassa = PaymentPlatform::where('name', 'Yookassa')->first();
            $yookassa->subscriptions_enabled = 1;
            $yookassa->save();
        } else {
            $yookassa = PaymentPlatform::where('name', 'Yookassa')->first();
            $yookassa->subscriptions_enabled = 0;
            $yookassa->save();
        }

        if (request('enable-paddle-subscription') == 'on') {
            $yookassa = PaymentPlatform::where('name', 'Paddle')->first();
            $yookassa->subscriptions_enabled = 1;
            $yookassa->save();
        } else {
            $yookassa = PaymentPlatform::where('name', 'Paddle')->first();
            $yookassa->subscriptions_enabled = 0;
            $yookassa->save();
        }

        toastr()->success(__('Payment settings successfully updated'));
        return redirect()->back();
    }

    /**
     * Record in .env file
     */
    private function storeConfiguration($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));         

        }
    }

    private function storeWithQuotes($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . '\'' . env($key) . '\'', $key . '=' . $value, file_get_contents($path)
            ));

        }
    }

}
