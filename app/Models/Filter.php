<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filter extends Model
{
    protected $table = 'filters';

    protected $fillable = ['name'];

    protected $casts = [
        'name' => 'array',
    ];

    public function filterOptions(): HasMany
    {
        return $this->hasMany(FilterOption::class, 'filter_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_filters', 'filter_id', 'category_id');
    }
}
