<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referrer_id',
        'referred_id',
        'referrer_email',
        'referred_email',
        'storage',
        'order_id',
        'payment',
        'commission',
        'rate',
        'status',
        'gateway',
        'purchase_date',
    ];

}
