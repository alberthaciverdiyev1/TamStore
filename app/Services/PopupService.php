<?php

namespace App\Services;

use App\Models\Popup;

class PopupService
{
    public function getActive(): ?Popup
    {
        return Popup::where('status', true)->first();
    }
}
