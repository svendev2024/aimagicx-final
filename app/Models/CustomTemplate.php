<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CustomTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'status',
        'professional',
        'template_code',
        'user_id',
        'name',
        'icon',
        'group',
        'slug',
        'prompt',
        'tone',
        'fields',
        'type',
        'package',
        'new'
    ];


    /**
     * Get the fields.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function fields(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 
}
