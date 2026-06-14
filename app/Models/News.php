<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';
    protected $fillable = ['category_id', 'title', 'description', 'image', 'status', 'tags'];

    protected $casts = [
        'tags' => 'array',
        'status' => 'boolean',
        'title' => 'array',
        'description' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class);
    }
}
