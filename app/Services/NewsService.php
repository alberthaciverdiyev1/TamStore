<?php

namespace App\Services;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Str;

class NewsService
{
    public function getAll(array $params = [], string $locale = null): \Illuminate\Support\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $locale ??= app()->getLocale();

        $query = News::with('category')
            ->where('status', true)
            ->when($params['category_id'] ?? null, fn ($q, $v) => $q->where('category_id', $v))
            ->when($params['search'] ?? null, fn ($q, $v) => $q->where(function ($q) use ($v) {
                $q->where('title', 'like', "%{$v}%")
                    ->orWhere('description', 'like', "%{$v}%");
            }))
            ->when($params['exclude_id'] ?? null, fn ($q, $v) => $q->where('id', '!=', $v))
            ->orderBy('created_at', 'desc');

        $mapper = fn (News $news) => (object)[
            'id' => $news->id,
            'title' => $news->title[$locale] ?? $news->title['az'] ?? '',
            'description' => $news->description[$locale] ?? $news->description['az'] ?? '',
            'image' => $news->image ? asset('storage/' . $news->image) : null,
            'category' => $news->category ? (object)[
                'id' => $news->category->id,
                'name' => $news->category->name[$locale] ?? $news->category->name['az'] ?? '',
            ] : null,
            'tags' => $news->tags,
            'date' => mb_strtoupper($news->created_at->locale('az')->translatedFormat('d F Y')),
            'reading_time' => $this->calculateReadingTime($news->description[$locale] ?? $news->description['az'] ?? ''),
        ];

        if (isset($params['page'])) {
            return $query->paginate($params['limit'] ?? 10, page: $params['page'])->through($mapper);
        }

        return $query->take($params['limit'] ?? 10)->get()->map($mapper);
    }

    public function find(int $id, string $locale = null): ?object
    {
        $locale ??= app()->getLocale();

        $news = News::with('category')->where('status', true)->find($id);

        if (!$news) {
            return null;
        }

        return (object)[
            'id' => $news->id,
            'title' => $news->title[$locale] ?? $news->title['az'] ?? '',
            'description' => ($news->description[$locale] ?? $news->description['az']) ? Str::words($news->description[$locale] ?? $news->description['az'], 70, '...') : '',
            'image' => $news->image ? asset('storage/' . $news->image) : null,
            'category' => $news->category ? (object)[
                'id' => $news->category->id,
                'name' => $news->category->name[$locale] ?? $news->category->name['az'] ?? '',
            ] : null,
            'tags' => $news->tags,
            'date' => mb_strtoupper($news->created_at->locale('az')->translatedFormat('d F Y')),
            'reading_time' => $this->calculateReadingTime($news->description[$locale] ?? $news->description['az'] ?? ''),
        ];
    }


    public function categories(array $params = [], string $locale = null): \Illuminate\Support\Collection
    {
        $locale ??= app()->getLocale();

        return NewsCategory::where('status', true)
            ->orderBy('created_at', 'desc')
            ->take($params['limit'] ?? 10)
            ->get()
            ->map(fn(NewsCategory $category) => (object)[
                'id' => $category->id,
                'name' => $category->name[$locale] ?? $category->name['az'] ?? '',
            ]);
    }

    private function calculateReadingTime(string $text): string
    {
        $cleanText = strip_tags($text);
        $wordCount = str_word_count($cleanText);
        $minutes = (int) ceil($wordCount / 200);

        return max(1, $minutes) . ' dəq oxuma';
    }
}
