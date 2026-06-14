<?php

namespace App\Services;

use App\Models\Branch;
use Illuminate\Support\Carbon;

class BranchService
{
    public function getAll(array $params = [], string $locale = null): \Illuminate\Support\Collection
    {
        $locale ??= app()->getLocale();

        $now = Carbon::now('Asia/Baku')->format('H:i:s');

        return Branch::where('status', true)
            ->orderBy('created_at', 'desc')
            ->when($params['search'] ?? null, fn ($q, $v) => $q->where(function ($q) use ($v) {
                $q->where('name', 'like', "%{$v}%")
                    ->orWhere('address', 'like', "%{$v}%");
            }))
            ->get()
            ->map(function (Branch $branch) use ($locale, $now) {
                $start = Carbon::parse($branch->working_hours_start)->format('H:i:s');
                $end = Carbon::parse($branch->working_hours_end)->format('H:i:s');

                return (object)[
                    'id'                  => $branch->id,
                    'name'                => $branch->name[$locale] ?? $branch->name['az'] ?? '',
                    'address'             => $branch->address[$locale] ?? $branch->address['az'] ?? '',
                    'working_hours_start' => $branch->working_hours_start,
                    'working_hours_end'   => $branch->working_hours_end,
                    'phone_1'             => $branch->phone_1,
                    'phone_2'             => $branch->phone_2,
                    'lat'                 => $branch->lat,
                    'lng'                 => $branch->lng,
                    'zoom'                => $branch->zoom,
                    'is_open'             => Carbon::parse($now)->between($start, $end),
                ];
            });
    }
}
