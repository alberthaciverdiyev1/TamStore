<?php

namespace App\Services;

use App\Models\Category;

class CategoryFilterService
{
    public function getAll(string $locale = null): \Illuminate\Support\Collection
    {
        $locale ??= app()->getLocale();

        return Category::where('status', true)
            ->with(['filters.filterOptions'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn (Category $category) => (object)[
                'id' => $category->id,
                'name' => $category->name[$locale] ?? $category->name['az'] ?? '',
                'info' => $category->info ? ($category->info[$locale] ?? $category->info['az'] ?? '') : '',
                'image' => $category->image ? asset('storage/' . $category->image) : null,
                'filters' => $category->filters->map(fn ($filter) => (object)[
                    'id' => $filter->id,
                    'name' => $filter->name[$locale] ?? $filter->name['az'] ?? '',
                    'options' => $filter->filterOptions->map(fn ($option) => (object)[
                        'id' => $option->id,
                        'value' => $option->value[$locale] ?? $option->value['az'] ?? '',
                    ]),
                ]),
            ]);
    }
}
