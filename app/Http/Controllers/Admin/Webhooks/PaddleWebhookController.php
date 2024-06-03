<?php

namespace App\Http\Controllers\Admin\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\PaymentProcessed;
use App\Events\PaymentReferrerBonus;
use App\Models\Subscriber;
use App\Models\SubscriptionPlan;
use App\Models\PrepaidPlan;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;


class PaddleWebhookController extends Controller
{

    public function handlePaddle(Request $request)
    {

        if ($request->alert_name == 'payment_succeeded') {
            
            $user_data = json_decode($request->passthrough);
            
            $payment = Payment::where('order_id', $user_data->order_id)->firstOrFail();
            $payment->order_id = $request->order_id;
            $payment->status = 'completed'; 
            $payment->save();

            if ($user_data->payment_type != 'prepaid') {
                $subscriber = Subscriber::where('subscription_id',  $user_data->order_id)->firstOrFail(); 
                $subscriber->status = 'Active';
                $subscriber->save();
            }
           
            if ($payment) {

                if ($user_data->payment_type != 'prepaid') {
                    $plan = SubscriptionPlan::where('id', $user_data->plan_id)->firstOrFail(); 
                } else {
                    $plan = PrepaidPlan::where('id', $user_data->plan_id)->firstOrFail(); 
                }               

                $user = User::where('id', $user_data->user_id)->firstOrFail();

                $tax_value = (config('payment.payment_tax') > 0) ? $plan->price * config('payment.payment_tax') / 100 : 0;
                $total_price = $tax_value + $plan->price;

                if (config('payment.referral.enabled') == 'on') {
                    if (config('payment.referral.payment.policy') == 'first') {
                        if (Payment::where('user_id', $user->id)->where('status', 'completed')->exists()) {
                            /** User already has at least 1 payment */
                        } else {
                            event(new PaymentReferrerBonus($user, $user_data->plan_id, $total_price, 'Paddle'));
                        }
                    } else {
                        event(new PaymentReferrerBonus($user, $user_data->plan_id, $total_price, 'Paddle'));
                    }
                }   
                
                if ($user_data->payment_type == 'prepaid') {
                    $user->available_words_prepaid = $user->available_words_prepaid + $plan->words;
                    $user->available_images_prepaid = $user->available_images_prepaid + $plan->images;
                    $user->available_chars_prepaid = $user->available_chars_prepaid + $plan->characters;
                    $user->available_minutes_prepaid = $user->available_minutes_prepaid + $plan->minutes;
                } else {
                    $group = ($user->hasRole('admin'))? 'admin' : 'subscriber';
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
                   
                }
    
                $user->save();

                event(new PaymentProcessed($user));

            }
        
        } elseif ($request->alert_name == 'subscription_created') {

            $user_data = json_decode($request->passthrough);
            
            $payment = Payment::where('order_id', $user_data->order_id)->firstOrFail();
            $payment->order_id = $request->subscription_id;
            $payment->status = 'completed'; 
            $payment->save();


            $subscriber = Subscriber::where('subscription_id',  $user_data->order_id)->firstOrFail(); 
            $subscriber->subscription_id = $request->subscription_id;
            $subscriber->paddle_cancel_url = $request->cancel_url;
            $subscriber->status = 'Active';
            $subscriber->save();
        
           
            if ($payment) {

                $plan = SubscriptionPlan::where('id', $user_data->plan_id)->firstOrFail(); 
               
                $user = User::where('id', $user_data->user_id)->firstOrFail();

                $tax_value = (config('payment.payment_tax') > 0) ? $plan->price * config('payment.payment_tax') / 100 : 0;
                $total_price = $tax_value + $plan->price;

                if (config('payment.referral.enabled') == 'on') {
                    if (config('payment.referral.payment.policy') == 'first') {
                        if (Payment::where('user_id', $user->id)->where('status', 'completed')->exists()) {
                            /** User already has at least 1 payment */
                        } else {
                            event(new PaymentReferrerBonus($user, $user_data->plan_id, $total_price, 'Paddle'));
                        }
                    } else {
                        event(new PaymentReferrerBonus($user, $user_data->plan_id, $total_price, 'Paddle'));
                    }
                }   
                

                $group = ($user->hasRole('admin'))? 'admin' : 'subscriber';
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

            }
            

        } elseif ($request->alert_name == 'subscription_payment_succeeded') {
            
            $subscriber = Subscriber::where('subscription_id', $request->subscription_id)->first();
            
            if ($subscriber) {
                
                $date1 = Carbon::createFromFormat('m/d/Y', $subscriber->created_at);
                $date2 = Carbon::createFromFormat('m/d/Y', $request->event_time);
            
                if ($date1->ne($date2)) {
                    
                    $plan = SubscriptionPlan::where('id', $subscriber->plan_id)->firstOrFail(); 
                   
                    $user = User::where('id', $subscriber->user_id)->firstOrFail();
                    
                    if (config('payment.referral.enabled') == 'on') {
                        if (config('payment.referral.payment.policy') == 'first') {
                            if (Payment::where('user_id', $user->id)->where('status', 'completed')->exists()) {
                                /** User already has at least 1 payment */
                            } else {
                                event(new PaymentReferrerBonus($user, $subcriber->plan_id, $total_price, 'PayPal'));
                            }
                        } else {
                            event(new PaymentReferrerBonus($user, $subscriber->plan_id, $total_price, 'PayPal'));
                        }
                    }
                    
                    $duration = ($plan->payment_frequency == 'monthly') ? 30 : 365;
                    
                    $subscriber->update(['status'=>'Active', 'active_until' => Carbon::now()->addDays($duration)]);
                    
                    $record_payment = new Payment();
                    $record_payment->user_id = $user->id;
                    $record_payment->plan_id = $plan->id;
                    $record_payment->order_id = $request->subscription_id;
                    $record_payment->plan_name = $plan->plan_name;
                    $record_payment->price = $request->sale_gross;
                    $record_payment->currency = $request->currency;
                    $record_payment->gateway = 'Paddle';
                    $record_payment->frequency = $plan->payment_frequency;
                    $record_payment->status = 'completed';
                    $record_payment->words = $plan->words;
                    $record_payment->images = $plan->images;
                    $record_payment->save();
                    
                    $group = ($user->hasRole('admin'))? 'admin' : 'subscriber';
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
                }
            
            }
            

        } elseif ($request->alert_name == 'subscription_payment_failed') {

            $subscriber = Subscriber::where('subscription_id', $request->subscription_id)->first();
            
            if ($subscriber) {
                $subscriber->update(['status'=>'Expired', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                
                $user = User::where('id', $subscriber->user_id)->firstOrFail();
                $group = ($user->hasRole('admin'))? 'admin' : 'user';
    
                $user->syncRoles($group);    
                $user->group = $group;
                $user->plan_id = null;
                $user->total_words = 0;
                $user->total_images = 0;
                $user->total_chars = 0;
                $user->total_minutes = 0;
                $user->member_limit = null;
                $user->save();
            }
        
        } elseif ($request->alert_name == 'subscription_cancelled') {

            $subscriber = Subscriber::where('subscription_id', $request->subscription_id)->first();
            
            if ($subscriber) {
                $subscriber->update(['status'=>'Cancelled', 'active_until' => Carbon::createFromFormat('Y-m-d H:i:s', now())]);
                
                $user = User::where('id', $subscriber->user_id)->firstOrFail();
                $group = ($user->hasRole('admin'))? 'admin' : 'user';
    
                $user->syncRoles($group);    
                $user->group = $group;
                $user->plan_id = null;
                $user->total_words = 0;
                $user->total_images = 0;
                $user->total_chars = 0;
                $user->total_minutes = 0;
                $user->member_limit = null;
                $user->save();
            }
        
        } 

    }
}
