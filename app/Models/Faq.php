<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    protected $table = 'faqs';

    protected $fillable = ['question', 'answer', 'sort_order', 'status'];

    protected $casts = [
        'question' => 'array',
        'answer' => 'array',
        'status' => 'boolean',
    ];
}
