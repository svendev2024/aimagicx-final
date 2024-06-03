<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Notification;
use App\Notifications\PayoutRequestNotification;
use App\Events\PayoutRequested;
use App\Models\User;

class PayoutRequestListener
{
    /**
     * Handle the event.
     *
     * @param  PayoutRequested  $event
     * @return void
     */
    public function handle(PayoutRequested $event)
    {
        $admins = User::role('admin')->get();

        Notification::send($admins, new PayoutRequestNotification($event->user));
    }
}
