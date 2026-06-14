<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    protected $table = 'banners';
    protected $fillable = ['first_title', 'second_title', 'third_title', 'image', 'status', 'page'];

    protected $casts = [
        'status' => 'boolean',
        'first_title' => 'array',
        'second_title' => 'array',
        'third_title' => 'array',
    ];

}
