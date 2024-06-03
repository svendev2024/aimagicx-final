<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceoverResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'title', 
        'project', 
        'text', 
        'text_raw', 
        'language', 
        'language_flag', 
        'voice', 
        'voice_id',
        'gender', 
        'vendor', 
        'file_name', 
        'vendor_id', 
        'storage', 
        'result_url',
        'result_ext',
        'characters',
        'voice_type',
        'plan_type',
        'audio_type',
        'mode',
        'expires_at',
    ];

    /**
     * Result belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
