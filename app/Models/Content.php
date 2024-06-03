<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
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
        'input_text',
        'result_text',
        'model',
        'language',
        'template_code',
        'tokens',
        'words',
        'plan_type',
        'workbook',
        'language_name',
        'language_flag',
        'template_name',
        'icon',
        'group'
    ];
}
