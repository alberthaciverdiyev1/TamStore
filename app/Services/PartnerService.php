<?php

namespace App\Services;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PartnerService
{
    public function getAll(): LengthAwarePaginator
    {
        return Partner::where('status', true)
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->through(fn (Partner $partner) => (object)[
                'id' => $partner->id,
                'image' => $partner->image ? asset('storage/' . $partner->image) : null,
            ]);
    }
}
