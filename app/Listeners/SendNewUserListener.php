<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Notification;
use App\Notifications\RegistrationNotification;
use App\Models\User;

class SendNewUserListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::role('admin')->get();

        Notification::send($admins, new RegistrationNotification($event->user));
    }
}
