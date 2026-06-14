<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FilterOption extends Model
{
    protected $table = 'filter_options';
    protected $fillable = ['filter_id', 'value'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'value' => 'array',
    ];

    public function filter():BelongsTo
    {
        return $this->belongsTo(Filter::class,'filter_id');
    }
}
