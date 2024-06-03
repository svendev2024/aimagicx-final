<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'url',
        'title',
        'status',
        'keywords',
        'body',
        'image',
    ];

    public function excerpt()
    {
        return Str::limit($this->body, 100);
    }
}
