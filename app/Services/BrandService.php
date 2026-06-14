<?php

namespace App\Services;

use App\Models\Brand;

class BrandService
{
    public function getAll(string $locale = null): \Illuminate\Support\Collection
    {
        return Brand::orderBy('name', 'asc')
            ->get()
            ->map(fn (Brand $brand) => (object)[
                'id' => $brand->id,
                'name' => $brand->name ?? '',
                'image' => $brand->image ? asset('storage/' . $brand->image) : null,
            ]);
    }

}
