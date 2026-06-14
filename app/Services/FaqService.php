<?php

namespace App\Services;

use App\Models\Faq;

class FaqService
{
    public function getAll()
    {
        $locale = app()->getLocale();

        return Faq::where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn (Faq $faq) => (object)[
                'id' => $faq->id,
                'question' => $faq->question[$locale] ?? $faq->question['az'] ?? '',
                'answer' => $faq->answer[$locale] ?? $faq->answer['az'] ?? '',
            ]);
    }
}
