<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'plan_id',
        'status',
        'gateway',
        'words',
        'images',
        'characters',
        'minutes',
        'subscription_id',
        'active_until',
        'frequency',
        'paddle_cancel_url',
        'model',
        'max_tokens',
        'paystack_customer_code',
        'paystack_authorization_code',
        'paystack_email_token',
    ];


    /**
     * Subscription belongs to a single user
     *
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Plan belongs to a single user
     *
     * 
     */
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }


    /**
     * Check if subscription is active
     *
     * 
     */
    public function isActive($id)
    {
        $subscription = Subscriber::where('status', 'Active')->where('user_id', $id)->first();
        \Log::info($subscription);
        if ($subscription) {
            return Carbon::parse($this->active_until)->isPast();
        } 
    }
}
