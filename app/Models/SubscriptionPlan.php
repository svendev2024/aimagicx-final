<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paypal_gateway_plan_id',
        'stripe_gateway_plan_id',
        'paystack_gateway_plan_id',
        'razorpay_gateway_plan_id',
        'flutterwave_gateway_plan_id',
        'paddle_gateway_plan_id',
        'status',
        'plan_name',
        'price',
        'currency',
        'words',
        'images',
        'payment_frequency',
        'primary_heading', 
        'featured',
        'model',
        'plan_features', 
        'free',
        'templates',
        'image_feature',
        'max_tokens',
        'characters',
        'minutes',
        'voiceover_feature',
        'transcribe_feature',
        'code_feature',
        'chat_feature',
        'chats',
        'image_storage_days',
        'voiceover_storage_days',
        'whisper_storage_days',
        'team_members'
    ];

    /**
     * Plan can have many subscribers
     * 
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscriber::class);
    }
}
