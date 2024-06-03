<?php

namespace App\Http\Controllers\Admin\Webhooks;

use App\Traits\ConsumesExternalServiceTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\PaymentProcessed;
use App\Events\PaymentReferrerBonus;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\SubscriptionPlan;
use App\Models\Payment;
use Carbon\Carbon;

class PaypalWebhookController extends Controller
{
    use ConsumesExternalServiceTrait;

    protected $baseURI;
    protected $clientID;
    protected $clientSecret;

    /**
     * Paypal Webhook processing, unless you are familiar with 
     * Paypal's REST API, we recommend not to modify it
     */
    public function __construct()
    {
        $this->baseURI = config('services.paypal.base_uri');
        $this->clientID = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }


    public function resolveAccessToken()
    {
        $credentials = base64_encode("{$this->clientID}:{$this->clientSecret}");

        return "Basic {$credentials}";
    }
    

    public function handlePaypal(Request $request)
    {
        $headers = getallheaders();
        $headers = array_change_key_case($headers, CASE_UPPER);
        $webhook_body = json_decode(file_get_contents('php://input'));


        $status = $this->makeRequest(
            'POST',
            '/v1/notifications/verify-webhook-signature',
            [],
            [   
                'transmission_id' => $headers['PAYPAL-TRANSMISSION-ID'],
                'transmission_time' => $headers['PAYPAL-TRANSMISSION-TIME'],
                'cert_url' => $headers['PAYPAL-CERT-URL'],
                'auth_algo' => $headers['PAYPAL-AUTH-ALGO'],
                'transmission_sig' => $headers['PAYPAL-TRANSMISSION-SIG'],
                'webhook_id' => config('services.paypal.webhook_id'),
                'webhook_event' => $webhook_body
            ],            
            [],
            $isJSONRequest = true,
        );

        $result = json_decode($status, true);

        if ($result['verification_status'] == "SUCCESS") {

            switch ($webhook_body->event_type) {
                case 'BILLING.SUBSCRIPTION.CANCELLED':
                        $subscription = Subscriber::where('subscription_id', $webhook_body->resource->billing_agreement_id)->firstOrFail();
                        $subscription->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())->endOfMonth()]);

                        $this->updateUserData($subscription->user_id);
                        
                        break;
                
                case 'BILLING.SUBSCRIPTION.SUSPENDED':
                        $subscription = Subscriber::where('subscription_id', $webhook_body->resource->billing_agreement_id)->firstOrFail();
                        $subscription->update(['status'=>'Suspended', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())->endOfMonth()]);
                        
                        $this->updateUserData($subscription->user_id);

                        break;

                case 'BILLING.SUBSCRIPTION.PAYMENT.FAILED':
                        $subscription = Subscriber::where('subscription_id', $webhook_body->resource->billing_agreement_id)->firstOrFail();
                        $subscription->update(['status'=>'Expired', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())->endOfMonth()]);
                        
                        $this->updateUserData($subscription->user_id);

                        break;

                case 'BILLING.SUBSCRIPTION.EXPIRED':
                        $subscription = Subscriber::where('subscription_id', $webhook_body->resource->billing_agreement_id)->firstOrFail();
                        $subscription->update(['status'=>'Expired', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())->endOfMonth()]);
                        
                        $this->updateUserData($subscription->user_id);

                        break;
                
                case 'PAYMENT.SALE.REFUNDED':
                        $subscription = Subscriber::where('subscription_id', $webhook_body->resource->billing_agreement_id)->firstOrFail();
                        $subscription->update(['status'=>'Refunded', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())->endOfMonth()]);
                        
                        $this->updateUserData($subscription->user_id);

                        break;

                case 'PAYMENT.SALE.REVERSED':
                    $subscription = Subscriber::where('subscription_id', $webhook_body->resource->billing_agreement_id)->firstOrFail();
                    $subscription->update(['status'=>'Reversed', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())->endOfMonth()]);
                    
                    $this->updateUserData($subscription->user_id);

                    break;

                case 'PAYMENT.SALE.COMPLETED':
                    $subscription = Subscriber::where('subscription_id', $webhook_body->resource->billing_agreement_id)->firstOrFail();
                    $plan = SubscriptionPlan::where('id', $subscription->plan_id)->firstOrFail();
                    $duration = ($plan->payment_frequency == 'monthly') ? 30 : 365;

                    $subscription->update(['status'=>'Active', 'active_until' => Carbon::now()->addDays($duration)]);
                    
                    $user = User::where('id', $subscription->user_id)->firstOrFail();

                    $tax_value = (config('payment.payment_tax') > 0) ? $plan->price * config('payment.payment_tax') / 100 : 0;
                    $total_price = $tax_value + $plan->price;

                    if (config('payment.referral.enabled') == 'on') {
                        if (config('payment.referral.payment.policy') == 'first') {
                            if (Payment::where('user_id', $user->id)->where('status', 'completed')->exists()) {
                                /** User already has at least 1 payment */
                            } else {
                                event(new PaymentReferrerBonus($user, $subscription->plan_id, $total_price, 'PayPal'));
                            }
                        } else {
                            event(new PaymentReferrerBonus($user, $subscription->plan_id, $total_price, 'PayPal'));
                        }
                    }

                    $record_payment = new Payment();
                    $record_payment->user_id = $user->id;
                    $record_payment->plan_id = $plan->id;
                    $record_payment->order_id = $subscription->plan_id;
                    $record_payment->plan_name = $plan->plan_name;
                    $record_payment->price = $total_price;
                    $record_payment->currency = $plan->currency;
                    $record_payment->gateway = 'PayPal';
                    $record_payment->frequency = $plan->payment_frequency;
                    $record_payment->status = 'completed';
                    $record_payment->words = $plan->words;
                    $record_payment->images = $plan->images;
                    $record_payment->save();
                    
                    $group = ($user->hasRole('admin')) ? 'admin' : 'subscriber';

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

                    event(new PaymentProcessed($user));

                    break;
            }
        }
    }


    private function updateUserData($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $group = ($user->hasRole('admin'))? 'admin' : 'user';

        if ($group == 'subscriber' || $group == 'user') {
            $user->syncRoles($group);    
            $user->group = $group;
            $user->plan_id = null;
            $user->total_words = 0;
            $user->total_images = 0;
            $user->available_words = 0;
            $user->available_images = 0;
            $user->member_limit = null;
            $user->save();
        } else {
            $user->syncRoles($group);    
            $user->group = $group;
            $user->plan_id = null;
            $user->save();
        }
    }

}
