<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = 'blogs';
    protected $fillable = ['title', 'description', 'image', 'status', 'tags', 'category_id' ];

    protected $casts = [
        'tags' => 'array',
        'status' => 'boolean',
        'title' => 'array',
        'description' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

}
