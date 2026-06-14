<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeCard extends Model
{
    use SoftDeletes;

    protected $table = 'home_cards';
    protected $fillable = ['icon', 'title', 'subtitle', 'image', 'status'];

    protected $casts = [
        'status' => 'boolean',
        'title' => 'array',
        'subtitle' => 'array',
    ];
}
