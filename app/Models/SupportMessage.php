<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'ticket_id', 
        'message', 
        'role',
        'attachment'
    ];

    /**
     * Support ticket belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
