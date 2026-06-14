<?php

namespace App\Services;

use App\Models\Gallery;

class GalleryService
{
    public function getAll(): \Illuminate\Support\Collection
    {
        return Gallery::where('status', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn (Gallery $gallery) => (object)[
                'id' => $gallery->id,
                'image' => $gallery->image ? asset('storage/' . $gallery->image) : null,
            ]);
    }
}
