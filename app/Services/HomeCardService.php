<?php

namespace App\Services;

use App\Models\HomeCard;

class HomeCardService
{
    public function getAll(string $locale = null): \Illuminate\Support\Collection
    {
        $locale ??= app()->getLocale();

        return HomeCard::where('status', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn (HomeCard $card) => (object)[
                'id' => $card->id,
                'icon' => $card->icon,
                'title' => $card->title[$locale] ?? $card->title['az'] ?? '',
                'subtitle' => $card->subtitle[$locale] ?? $card->subtitle['az'] ?? '',
                'image' => $card->image ? asset('storage/' . $card->image) : null,
            ]);
    }
}
