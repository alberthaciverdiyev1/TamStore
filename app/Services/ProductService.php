<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getAll(Request $request): LengthAwarePaginator
    {
        $locale = app()->getLocale();
        $query = Product::query()->where('status', true);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('categories') && is_array($request->input('categories'))) {
            $query->whereIn('category_id', $request->input('categories'));
        }

        if ($request->filled('brands') && is_array($request->input('brands'))) {
            $query->whereIn('brand_id', $request->input('brands'));
        }

        if ($request->filled('filters') && is_array($request->input('filters'))) {
            $query->whereHas('filterOptions', function ($q) use ($request) {
                $q->whereIn('filter_id', $request->input('filters'));
            });
        }

        if ($request->filled('filter_options') && is_array($request->input('filter_options'))) {
            $query->whereHas('filterOptions', function ($q) use ($request) {
                $q->whereIn('filter_option_id', $request->input('filter_options'));
            });
        }

        return $query
            ->with(['category', 'mainImage'])
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->through(fn(Product $product) => (object)[
                'id'            => $product->id,
                'slug'          => $product->slug,
                'name'          => $product->name[$locale] ?? $product->name['az'] ?? '',
                'category_name' => $product->category?->name[$locale] ?? $product->category?->name['az'] ?? '',
                'image'         => $product->mainImage?->image
                    ? asset('storage/' . $product->mainImage->image)
                    : null,
            ]);
    }

    public function details(string $slug): object
    {
        $locale = app()->getLocale();

        $product = Product::query()
            ->with(['category', 'mainImage', 'images', 'filterOptions.filter'])
            ->where('slug', $slug)
            ->firstOrFail();

        $groupedFilters = $product->filterOptions
            ->groupBy('filter_id')
            ->map(function ($options) use ($locale) {
                $filter = $options->first()->filter;

                return (object)[
                    'id' => $filter?->id,
                    'name' => $filter?->name[$locale] ?? $filter?->name['az'] ?? '',
                    'options' => $options->map(fn ($option) => (object)[
                        'id' => $option->id,
                        'name' => $option->value[$locale] ?? $option->value['az'] ?? ''
                    ])->values()->all()
                ];
            })
            ->values()
            ->all();

        return (object)[
            'id'                => $product->id,
            'slug'              => $product->slug,
            'name'              => $product->name[$locale] ?? $product->name['az'] ?? '',
            'short_description' => $product->short_description[$locale] ?? $product->short_description['az'] ?? '',
            'description'       => $product->description[$locale] ?? $product->description['az'] ?? '',
            'tags'              => $product->tags ?? [],
            'category_name'     => $product->category?->name[$locale] ?? $product->category?->name['az'] ?? '',
            'category_id'       => $product->category?->id ?? null,
            'images'            => $product->images->map(function ($img) {
                return $img->image ? asset('storage/' . $img->image) : null;
            })->filter()->values()->all(),
            'filters'           => $groupedFilters,
        ];
    }
}
