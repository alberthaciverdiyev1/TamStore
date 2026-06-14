<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Filter;

class FilterService
{
    public function getAll(string $locale = null): \Illuminate\Support\Collection
    {
        $locale ??= app()->getLocale();

        return Filter::with('filterOptions')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn (Filter $filter) => (object)[
                'id' => $filter->id,
                'name' => $filter->name[$locale] ?? $filter->name['az'] ?? '',
                'options' => $filter->filterOptions->map(fn ($option) => (object)[
                    'id' => $option->id,
                    'value' => $option->value[$locale] ?? $option->value['az'] ?? '',
                ]),
            ]);
    }
}
