<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $table = 'popups';

    protected $fillable = ['image', 'url', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Popup $popup) {
            if ($popup->status) {
                static::where('id', '!=', $popup->id)->update(['status' => false]);
            }
        });
    }
}
