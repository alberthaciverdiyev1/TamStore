<?php

namespace App\Services;

use App\Models\Banner;

class BannerService
{
    public function getByPage(string $page, string $locale = null)
    {
        $locale ??= app()->getLocale();
        $query = Banner::where('status', true)->where('page', $page);

        $mapper = fn ($banner) => (object)[
            'id'           => $banner->id,
            'first_title'  => $banner->first_title[$locale] ?? $banner->first_title['az'] ?? '',
            'second_title' => $banner->second_title[$locale] ?? $banner->second_title['az'] ?? '',
            'third_title'  => $banner->third_title[$locale] ?? $banner->third_title['az'] ?? '',
            'image'        => $banner->image ? asset('storage/' . $banner->image) : null,
            'page'         => $banner->page,
        ];

        if ($page === 'home') {
            return $query->latest()->get()->map($mapper);
        }

        $banner = $query->latest()->first();
        return $banner ? $mapper($banner) : null;
    }
}
