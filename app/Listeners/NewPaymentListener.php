<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Notification;
use App\Notifications\PaymentNotification;
use App\Events\PaymentProcessed;
use App\Models\User;

class NewPaymentListener
{
    /**
     * Handle the event.
     *
     * @param  PaymentProcessed  $event
     * @return void
     */
    public function handle(PaymentProcessed $event)
    {
        $admins = User::role('admin')->get();

        Notification::send($admins, new PaymentNotification($event->user));
    }
}
