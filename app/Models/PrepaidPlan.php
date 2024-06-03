<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrepaidPlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'plan_name',
        'price',
        'currency',
        'words',
        'images',
        'featured',
        'pricing_plan',
        'characters',
        'minutes',
    ];
}
