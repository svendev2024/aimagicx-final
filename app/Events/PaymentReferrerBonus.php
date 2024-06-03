<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentReferrerBonus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $order_id;
    public $payment;
    public $gateway;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $order_id, $payment, $gateway)
    {
        $this->user = $user;
        $this->order_id = $order_id;
        $this->payment = $payment;
        $this->gateway = $gateway;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
