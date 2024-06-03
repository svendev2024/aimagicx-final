<?php

namespace App\Listeners;

use App\Events\PaymentReferrerBonus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Referral;
use App\Models\User;

class AddCommissionsListener
{
    /**
     * Handle the event.
     *
     * @param  ReferrerBonus  $event
     * @return void
     */
    public function handle(PaymentReferrerBonus $event)
    {
        if ($event->user->referred_by) {
            $referrer = User::where('id', $event->user->referred_by)->firstOrFail();

            $commission = ($event->payment * config('payment.referral.payment.commission'))/100;
            $total = $referrer->balance + $commission;
            $referrer->balance = $total;
            $referrer->save();

            Referral::create([
                'referrer_id' => $referrer->id,
                'referrer_email' => $referrer->email,
                'referred_id' => $event->user->id,
                'referred_email' => $event->user->email,
                'order_id' => $event->order_id,
                'payment' => $event->payment,
                'commission' => $commission,
                'rate' => config('payment.referral.payment.commission'),
                'status' => 'Complete',
                'gateway' => $event->gateway,
                'purchase_date' => now(),
            ]);  

        }
    }
}
