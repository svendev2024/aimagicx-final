<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PayoutRequestNotification extends Notification
{
    use Queueable;
    
    private $user;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            
            'type' => 'payout-request',
            'name' => $this->user->name,
            'email' => $this->user->email,
            'subject' => 'New Payout Request has been submitted by the User',
            'country' => $this->user->country
        ];
    }
}
