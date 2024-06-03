<?php

namespace App\Http\Controllers\User;

use App\Traits\InvoiceGeneratorTrait;
use App\Http\Controllers\Controller;
use App\Events\PaymentReferrerBonus;
use App\Services\PaymentPlatformResolverService;
use App\Events\PaymentProcessed;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PaymentPlatform;
use App\Models\Payment;
use App\Models\Subscriber;
use App\Models\SubscriptionPlan;
use App\Models\PrepaidPlan;
use App\Models\User;
use Carbon\Carbon;

use KingFlamez\Rave\Facades\Rave as Flutterwave;


class PaymentController extends Controller
{   
    use InvoiceGeneratorTrait;

    protected $paymentPlatformResolver;

    
    public function __construct(PaymentPlatformResolverService $paymentPlatformResolver)
    {
        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request, SubscriptionPlan $id)
    {
        if ($id->free) {

            $order_id = $this->registerFreeSubscription($id);
            $plan = SubscriptionPlan::where('id', $id->id)->first();

            return view('user.plans.success', compact('plan', 'order_id'));

        } else {

            $rules = [
                'payment_platform' => ['required', 'exists:payment_platforms,id'],
            ];

            $request->validate($rules);

            $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);

            session()->put('subscriptionPlatformID', $request->payment_platform);
            session()->put('gatewayID', $request->payment_platform);
            
            return $paymentPlatform->handlePaymentSubscription($request, $id);
        }
    }


    /**
     * Process prepaid plan request
     */
    public function payPrePaid(Request $request)
    {
        if ($request->type == 'lifetime') {
            $id = SubscriptionPlan::where('id', $request->id)->first();
            $type = 'lifetime';
        } else {
            $id = PrepaidPlan::where('id', $request->id)->first();
            $type = 'prepaid';
        }

        if ($request->value < 1) {
            if ($type == 'lifetime') {
                $plan = SubscriptionPlan::where('id', $request->id)->first();
                $order_id = $this->registerFreeSubscription($plan);

                return view('user.plans.success', compact('plan', 'order_id'));

            } else {
                $plan = PrepaidPlan::where('id', $request->id)->first();
                auth()->user()->available_words_prepaid = auth()->user()->available_words_prepaid + $plan->words;
                auth()->user()->available_images_prepaid = auth()->user()->available_images_prepaid + $plan->images;
                auth()->user()->available_chars_prepaid = auth()->user()->available_chars_prepaid + $plan->characters;
                auth()->user()->available_minutes_prepaid = auth()->user()->available_minutes_prepaid + $plan->minutes;
                auth()->user()->save();   
                $order_id = Str::random(10);
                return view('user.plans.success', compact('plan', 'order_id'));
            }
            
        }
        
        $rules = [
            'payment_platform' => ['required', 'exists:payment_platforms,id'],
        ];

        $request->validate($rules);


        $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);
           

        session()->put('paymentPlatformID', $request->payment_platform);
    
        return $paymentPlatform->handlePaymentPrePaid($request, $id->id, $type);       
    }

    /**
     * Process approved prepaid plan requests
     */
    public function approved(Request $request)
    {   
        if (session()->has('paymentPlatformID')) {
            $paymentPlatform = $this->paymentPlatformResolver->resolveService(session()->get('paymentPlatformID'));

            return $paymentPlatform->handleApproval($request);
        }

        toastr()->error(__('There was an error while retrieving payment gateway. Please try again'));
        return redirect()->back();
    }


    /**
     * Process approved prepaid plan request for Razorpay
     */
    public function approvedRazorpayPrepaid(Request $request)
    {   
        if (session()->has('paymentPlatformID')) {
            $paymentPlatform = $this->paymentPlatformResolver->resolveService(session()->get('paymentPlatformID'));

            return $paymentPlatform->handleApproval($request);
        }

        toastr()->error(__('There was an error while retrieving payment gateway. Please try again'));
        return redirect()->back();
    }


    /**
     * Process approved prepaid plan request for Braintree
     */
    public function braintreeSuccess(Request $request)
    {
        $plan = PrepaidPlan::where('id', $request->plan)->first();
        $order_id = request('amp;order');
        
        return view('user.plans.success', compact('plan', 'order_id'));
    }


    public function paddleSuccess() 
    {
        $plan = session()->get('plan_id');
        $order_id = 'random';  

        return view('user.plans.success', compact('plan', 'order_id'));
    }


    /**
     * Process cancelled prepaid plan requests
     */
    public function cancelled()
    {
        toastr()->warning(__('You cancelled the payment process. Would like to try again?'));
        return redirect()->route('user.plans');
    }


    /**
     * Process approved subscription plan requests
     */
    public function approvedSubscription(Request $request)
    {   
        if (session()->has('subscriptionPlatformID')) {
            $paymentPlatform = $this->paymentPlatformResolver->resolveService(session()->get('subscriptionPlatformID'));

            if (session()->has('subscriptionID')) {
                $subscriptionID = session()->get('subscriptionID');
            }

            if ($paymentPlatform->validateSubscriptions($request)) {

                $plan = SubscriptionPlan::where('id', $request->plan_id)->firstOrFail();
                $user = $request->user();

                $gateway_id = session()->get('gatewayID');
                $gateway = PaymentPlatform::where('id', $gateway_id)->firstOrFail();
                $duration = $plan->payment_frequency;
                $days = ($duration == 'monthly') ? 30 : 365;

                $subscription = Subscriber::create([
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'status' => 'Active',
                    'created_at' => now(),
                    'gateway' => $gateway->name,
                    'frequency' => $plan->payment_frequency,
                    'plan_name' => $plan->plan_name,
                    'words' => $plan->words,
                    'images' => $plan->images,
                    'characters' => $plan->characters,
                    'minutes' => $plan->minutes,
                    'subscription_id' => $subscriptionID,
                    'active_until' => Carbon::now()->addDays($days),
                ]);       

                // Only for Paystack
                if ($gateway_id == 4) {
                    $reference = $paymentPlatform->addPaystackFields($request->reference, $subscription->id);
                }

                session()->forget('gatewayID');

                $this->registerSubscriptionPayment($plan, $user, $subscriptionID, $gateway->name);               
                $order_id = $subscriptionID;
                
                return view('user.plans.success', compact('plan', 'order_id'));
            }
        }

        toastr()->error(__('There was an error while checking your subscription. Please try again'));
        return redirect()->back();
    }


    /**
     * Process approved razorpay subscription plan requests
     */
    public function approvedRazorpaySubscription(Request $request)
    {   
        if (session()->has('subscriptionPlatformID')) {
            $paymentPlatform = $this->paymentPlatformResolver->resolveService(session()->get('subscriptionPlatformID'));

            if (session()->has('subscriptionID')) {
                $subscriptionID = session()->get('subscriptionID');
            }

            if ($paymentPlatform->validateSubscriptions($request)) {

                $plan = SubscriptionPlan::where('id', $request->plan_id)->firstOrFail();

                $gateway_id = session()->get('gatewayID');
                $gateway = PaymentPlatform::where('id', $gateway_id)->firstOrFail();
                $duration = $plan->payment_frequency;
                $days = ($duration == 'monthly') ? 30 : 365;

                $subscription = Subscriber::create([
                    'user_id' => auth()->user()->id,
                    'plan_id' => $plan->id,
                    'status' => 'Active',
                    'created_at' => now(),
                    'gateway' => $gateway->name,
                    'frequency' => $plan->payment_frequency,
                    'plan_name' => $plan->plan_name,
                    'words' => $plan->words,
                    'images' => $plan->images,
                    'characters' => $plan->characters,
                    'minutes' => $plan->minutes,
                    'subscription_id' => $subscriptionID,
                    'active_until' => Carbon::now()->addDays($days),
                ]);       

                session()->forget('gatewayID');

                $this->registerSubscriptionPayment($plan, auth()->user(), $subscriptionID, $gateway->name);               
                $order_id = $subscriptionID;

                return view('user.plans.success', compact('plan', 'order_id'));
            }
        }

        toastr()->error(__('There was an error with payment verification. Please try again or contact support'));
        return redirect()->route('user.plans');
    }


    /**
     * Process approved flutterwave subscription plan requests
     */
    public function approvedFlutterwaveSubscription(Request $request)
    {   
        $status = request()->status;

        if ($status ==  'successful') {
    
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            $order_id = $data['data']['tx_ref'];
            $subscriptionID = $data['data']['id'];

            $plan = session()->get('plan_id');

            $duration = $plan->payment_frequency;
            $days = ($duration == 'monthly') ? 30 : 365;

            $subscription = Subscriber::create([
                'user_id' => auth()->user()->id,
                'plan_id' => $plan->id,
                'status' => 'Active',
                'created_at' => now(),
                'gateway' => 'Flutterwave',
                'frequency' => $plan->payment_frequency,
                'plan_name' => $plan->plan_name,
                'words' => $plan->words,
                'images' => $plan->images,
                'characters' => $plan->characters,
                'minutes' => $plan->minutes,
                'subscription_id' => $subscriptionID,
                'active_until' => Carbon::now()->addDays($days),
            ]);       

            session()->forget('gatewayID');
            session()->forget('plan_id');

            $this->registerSubscriptionPayment($plan, auth()->user(), $subscriptionID, 'Flutterwave');               
            $order_id = $subscriptionID;

            return view('user.plans.success', compact('plan', 'order_id'));

        } elseif ($status == 'cancelled'){
            toastr()->error(__('Payment has been cancelled'));
            return redirect()->back();
        } else{
            toastr()->error(__('Payment was not successful, please try again'));
            return redirect()->back();
        }
         

    }


    /**
     * Process cancelled subscription plan requests
     */
    public function cancelledSubscription()
    {   
        toastr()->warning(__('You cancelled the payment process. Would like to try again?'));
        return redirect()->route('user.plans');
    }


    /**
     * Register subscription payment in DB
     */
    private function registerSubscriptionPayment(SubscriptionPlan $plan, User $user, $subscriptionID, $gateway)
    {
        $tax_value = (config('payment.payment_tax') > 0) ? $plan->price * config('payment.payment_tax') / 100 : 0;
        $total_price = $tax_value + $plan->price;

        if (config('payment.referral.enabled') == 'on') {
            if (config('payment.referral.payment.policy') == 'first') {
                if (Payment::where('user_id', $user->id)->where('status', 'completed')->exists()) {
                    /** User already has at least 1 payment */
                } else {
                    event(new PaymentReferrerBonus(auth()->user(), $subscriptionID, $total_price, $gateway));
                }
            } else {
                event(new PaymentReferrerBonus(auth()->user(), $subscriptionID, $total_price, $gateway));
            }
        }

        $record_payment = new Payment();
        $record_payment->user_id = $user->id;
        $record_payment->plan_id = $plan->id;
        $record_payment->order_id = $subscriptionID;
        $record_payment->plan_name = $plan->plan_name;
        $record_payment->frequency = $plan->payment_frequency;
        $record_payment->price = $total_price;
        $record_payment->currency = $plan->currency;
        $record_payment->gateway = $gateway;
        $record_payment->status = 'completed';
        $record_payment->words = $plan->words;
        $record_payment->images = $plan->images;
        $record_payment->characters = $plan->characters;
        $record_payment->minutes = $plan->minutes;
        $record_payment->save();
        
        $group = ($user->hasRole('admin'))? 'admin' : 'subscriber';

        $user = User::where('id', $user->id)->first();
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
        $user->save();       

        event(new PaymentProcessed(auth()->user()));
   
    }   
    
    
    /**
     * Generate Invoice after payment
     */
    public function generatePaymentInvoice($order_id)
    {              
        $this->generateInvoice($order_id);
    }


    /**
     * Bank Transfer Invoice
     */
    public function bankTransferPaymentInvoice($order_id)
    {
        $this->bankTransferInvoice($order_id);
    }


    /**
     * Show invoice for past payments
     */
    public function showPaymentInvoice(Payment $id)
    {   
        if ($id->gateway == 'BankTransfer' && $id->status != 'completed') {
            $this->bankTransferInvoice($id->order_id);
        } else {          
            $this->showInvoice($id);
        }
    }


    /**
     * Cancel active subscription
     */
    public function stopSubscription(Request $request)
    {   
        if ($request->ajax()) {
            
            $id = Subscriber::where('id', $request->id)->first();

            if ($id->status == 'Cancelled') {
                $data['status'] = 200;
                $data['message'] = __('This subscription was already cancelled before');
                return $data;
            } elseif ($id->status == 'Suspended') {
                $data['status'] = 400;
                $data['message'] = __('Subscription has been suspended due to failed renewal payment');
                return $data;
            } elseif ($id->status == 'Expired') {
                $data['status'] = 400;
                $data['message'] = __('Subscription has been expired, please create a new one');
                return $data;
            }

            if ($id->frequency == 'lifetime') {
                $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                $user = User::where('id', $id->user_id)->firstOrFail();
                $user->plan_id = null;
                $user->group = 'user';
                $user->total_words = 0;
                $user->total_images = 0;
                $user->total_chars = 0;
                $user->total_minutes = 0;
                $user->member_limit = null;
                $user->save();

                $data['status'] = 200;
                $data['message'] = __('Subscription has been successfully cancelled');
                return $data;

            } else {

                switch ($id->gateway) {
                    case 'PayPal':
                        $platformID = 1;
                        break;
                    case 'Stripe':
                        $platformID = 2;
                        break;
                    case 'BankTransfer':
                        $platformID = 3;
                        break;
                    case 'Paystack':
                        $platformID = 4;
                        break;
                    case 'Razorpay':
                        $platformID = 5;
                        break;
                    case 'Mollie':
                        $platformID = 7;
                        break;
                    case 'Flutterwave':
                        $platformID = 10;
                        break;
                    case 'Yookassa':
                        $platformID = 11;
                        break;
                    case 'Paddle':
                        $platformID = 12;
                        break;
                    case 'FREE':
                        $platformID = 99;
                        break;
                    default:
                        $platformID = 1;
                        break;
                }
                

                if ($id->gateway == 'PayPal' || $id->gateway == 'Stripe' || $id->gateway == 'Paystack' || $id->gateway == 'Razorpay' || $id->gateway == 'Mollie' || $id->gateway == 'Flutterwave' || $id->gateway == 'Yookassa' || $id->gateway == 'Paddle') {
                    $paymentPlatform = $this->paymentPlatformResolver->resolveService($platformID);

                    $status = $paymentPlatform->stopSubscription($id->subscription_id);

                    if ($platformID == 2) {
                        if ($status->cancel_at) {
                            $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                            $user = User::where('id', $id->user_id)->firstOrFail();
                            $user->plan_id = null;
                            $user->group = 'user';
                            $user->total_words = 0;
                            $user->total_images = 0;
                            $user->total_chars = 0;
                            $user->total_minutes = 0;
                            $user->member_limit = null;
                            $user->save();
                        }
                    } elseif ($platformID == 4) {
                        if ($status->status) {
                            $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                            $user = User::where('id', $id->user_id)->firstOrFail();
                            $user->plan_id = null;
                            $user->group = 'user';
                            $user->total_words = 0;
                            $user->total_images = 0;
                            $user->total_chars = 0;
                            $user->total_minutes = 0;
                            $user->member_limit = null;
                            $user->save();
                        }
                    } elseif ($platformID == 5) {
                        if ($status->status == 'cancelled') {
                            $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                            $user = User::where('id', $id->user_id)->firstOrFail();
                            $user->plan_id = null;
                            $user->group = 'user';
                            $user->total_words = 0;
                            $user->total_images = 0;
                            $user->total_chars = 0;
                            $user->total_minutes = 0;
                            $user->member_limit = null;
                            $user->save();
                        }
                    } elseif ($platformID == 7) {
                        if ($status->status == 'Cancelled') {
                            $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                            $user = User::where('id', $id->user_id)->firstOrFail();
                            $user->plan_id = null;
                            $user->group = 'user';
                            $user->total_words = 0;
                            $user->total_images = 0;
                            $user->total_chars = 0;
                            $user->total_minutes = 0;
                            $user->member_limit = null;
                            $user->save();
                        }
                    } elseif ($platformID == 10) {
                        if ($status == 'cancelled') {
                            $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                            $user = User::where('id', $id->user_id)->firstOrFail();
                            $user->plan_id = null;
                            $user->group = 'user';
                            $user->total_words = 0;
                            $user->total_images = 0;
                            $user->total_chars = 0;
                            $user->total_minutes = 0;
                            $user->member_limit = null;
                            $user->save();
                        }
                    } elseif ($platformID == 11) {
                        if ($status == 'cancelled') {
                            $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                            $user = User::where('id', $id->user_id)->firstOrFail();
                            $user->plan_id = null;
                            $user->group = 'user';
                            $user->total_words = 0;
                            $user->total_images = 0;
                            $user->total_chars = 0;
                            $user->total_minutes = 0;
                            $user->member_limit = null;
                            $user->save();
                        }
                    } elseif ($platformID == 12) {
                        if ($status == 'cancelled') {
                            $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                            $user = User::where('id', $id->user_id)->firstOrFail();
                            $user->plan_id = null;
                            $user->group = 'user';
                            $user->total_words = 0;
                            $user->total_images = 0;
                            $user->total_chars = 0;
                            $user->total_minutes = 0;
                            $user->member_limit = null;
                            $user->save();
                        }
                    } elseif ($platformID == 99) { 
                        $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                        $user = User::where('id', $id->user_id)->firstOrFail();
                        $user->plan_id = null;
                        $user->group = 'user';
                        $user->total_words = 0;
                        $user->total_images = 0;
                        $user->total_chars = 0;
                        $user->total_minutes = 0;
                        $user->member_limit = null;
                        $user->save();
                    } else {
                        if (is_null($status)) {
                            $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                            $user = User::where('id', $id->user_id)->firstOrFail();
                            $user->plan_id = null;
                            $user->group = 'user';
                            $user->total_words = 0;
                            $user->total_images = 0;
                            $user->total_chars = 0;
                            $user->total_minutes = 0;
                            $user->member_limit = null;
                            $user->save();
                        }
                    }
                } else {
                    $id->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                    $user = User::where('id', $id->user_id)->firstOrFail();
                    $user->plan_id = null;
                    $user->group = 'user';
                    $user->total_words = 0;
                    $user->total_images = 0;
                    $user->total_chars = 0;
                    $user->total_minutes = 0;
                    $user->member_limit = null;
                    $user->save();
                }
                
                $data['status'] = 200;
                $data['message'] = __('Subscription has been successfully cancelled');
                return $data;
            }
            
        }
        
    }


    /**
     * Register free subscription
     */
    private function registerFreeSubscription(SubscriptionPlan $plan)
    {
        $order_id = Str::random(10);
        $subscription = Str::random(10);
        $duration = $plan->payment_frequency;
        $days = ($duration == 'monthly') ? 30 : 365;

        $record_payment = new Payment();
        $record_payment->user_id = auth()->user()->id;
        $record_payment->plan_id = $plan->id;
        $record_payment->frequency = $plan->payment_frequency;
        $record_payment->order_id = $order_id;
        $record_payment->plan_name = $plan->plan_name;
        $record_payment->price = 0;
        $record_payment->currency = $plan->currency;
        $record_payment->gateway = 'FREE';
        $record_payment->status = 'completed';
        $record_payment->words = $plan->words;
        $record_payment->characters = $plan->characters;
        $record_payment->minutes = $plan->minutes;
        $record_payment->save();

        $subscription = Subscriber::create([
            'user_id' => auth()->user()->id,
            'plan_id' => $plan->id,
            'status' => 'Active',
            'created_at' => now(),
            'gateway' => 'FREE',
            'frequency' => $plan->payment_frequency,
            'words' => $plan->words,
            'characters' => $plan->characters,
            'minutes' => $plan->minutes,
            'subscription_id' => $subscription,
            'active_until' => Carbon::now()->addDays($days),
        ]); 
        
        $group = (auth()->user()->hasRole('admin'))? 'admin' : 'subscriber';

        $user = User::where('id', auth()->user()->id)->first();
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
        $user->save();       
        
        return $order_id;
    } 
}
