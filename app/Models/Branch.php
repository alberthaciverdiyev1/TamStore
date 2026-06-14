<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'address', 'working_hours_start','working_hours_end', 'phone_1', 'phone_2', 'lat', 'lng', 'zoom', 'status'];

    protected $casts = [
        'status' => 'boolean',
        'name' => 'array',
        'address' => 'array',
    ];
}
