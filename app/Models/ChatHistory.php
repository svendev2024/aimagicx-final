<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'chat_code',
        'message_code',
        'chat',
        'messages',
        'favorite',
        'title'
    ];

    protected $casts = [
        'chat' => 'array',
      ];
}
 