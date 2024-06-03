<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transcript',
        'title',
        'task',
        'url',
        'format',
        'description',
        'size', 
        'length',
        'storage', 
        'plan_type',
        'temp_name',
        'file_name',
        'expires_at',
        'words',
        'workbook',
        'audio_type'
    ];
}
