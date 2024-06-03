<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
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
        'category', 
        'priority', 
        'subject', 
        'status',
        'resolved_on'
    ];

    /**
     * Support ticket belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
