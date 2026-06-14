<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAll(string $locale = null): \Illuminate\Support\Collection
    {
        $locale ??= app()->getLocale();

        return Category::where('status', true)
            ->with('filters')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn (Category $category) => (object)[
                'id' => $category->id,
                'name' => $category->name[$locale] ?? $category->name['az'] ?? '',
                'info' => $category->info[$locale] ?? $category->info['az'] ?? '',
                'image' => $category->image ? asset('storage/' . $category->image) : null,
                'filters' => $category->filters->map(fn ($filter) => (object)[
                    'id' => $filter->id,
                    'name' => $filter->name[$locale] ?? $filter->name['az'] ?? '',
                ]),
            ]);
    }
}
