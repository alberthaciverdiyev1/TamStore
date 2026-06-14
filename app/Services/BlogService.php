<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogService
{


    public function categories(array $params = [], string $locale = null): \Illuminate\Support\Collection
    {
        $locale ??= app()->getLocale();

        return BlogCategory::where('status', true)
            ->orderBy('created_at', 'desc')
            ->take($params['limit'] ?? 10)
            ->get()
            ->map(fn(BlogCategory $category) => (object)[
                'id' => $category->id,
                'name' => $category->name[$locale] ?? $category->name['az'] ?? '',
            ]);
    }

    public function getAll(array $params = [], string $locale = null): \Illuminate\Support\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $locale ??= app()->getLocale();

        $query = Blog::with('category')
            ->where('status', true)
            ->when($params['category_id'] ?? null, fn($q, $v) => $q->where('category_id', $v))
            ->when($params['search'] ?? null, fn($q, $v) => $q->where(function ($q) use ($v) {
                $q->where('title', 'like', "%{$v}%")
                    ->orWhere('description', 'like', "%{$v}%");
            }))
            ->when($params['exclude_id'] ?? null, fn($q, $v) => $q->where('id', '!=', $v))
            ->orderBy('created_at', 'desc');

        $mapper = fn (Blog $blog) => (object)[
            'id' => $blog->id,
            'title' => $blog->title[$locale] ?? $blog->title['az'] ?? '',
            'description' => $blog->description[$locale] ?? $blog->description['az'] ?? '',
            'image' => $blog->image ? asset('storage/' . $blog->image) : null,
            'category' => $blog->category ? (object)[
                'id' => $blog->category->id,
                'name' => $blog->category->name[$locale] ?? $blog->category->name['az'] ?? '',
            ] : null,
            'tags' => $blog->tags,
            'date' => mb_strtoupper($blog->created_at->locale('az')->translatedFormat('d F Y')),
            'reading_time' => $this->calculateReadingTime($blog->description[$locale] ?? $blog->description['az'] ?? ''),
        ];

        if (isset($params['page'])) {
            return $query->paginate($params['limit'] ?? 10, page: $params['page'])->through($mapper);
        }

        return $query->take($params['limit'] ?? 10)->get()->map($mapper);
    }

    public function find(int $id, string $locale = null): ?object
    {
        $locale ??= app()->getLocale();

        $blog = Blog::with('category')->where('status', true)->find($id);

        if (!$blog) {
            return null;
        }

        return (object)[
            'id' => $blog->id,
            'title' => $blog->title[$locale] ?? $blog->title['az'] ?? '',
            'description' => ($blog->description[$locale] ?? $blog->description['az']) ? Str::words($blog->description[$locale] ?? $blog->description['az'], 70,'...') : '',
            'image' => $blog->image ? asset('storage/' . $blog->image) : null,
            'category' => $blog->category ? (object)[
                'id' => $blog->category->id,
                'name' => $blog->category->name[$locale] ?? $blog->category->name['az'] ?? '',
            ] : null,
            'tags' => $blog->tags,
            'date' => mb_strtoupper($blog->created_at->locale('az')->translatedFormat('d F Y')),
            'reading_time' => $this->calculateReadingTime($blog->description[$locale] ?? $blog->description['az'] ?? ''),
        ];
    }

    private function calculateReadingTime(string $text): string
    {
        $cleanText = strip_tags($text);
        $wordCount = str_word_count($cleanText);
        $minutes = (int)ceil($wordCount / 200);

        return max(1, $minutes) . ' dəq oxuma';
    }
}
