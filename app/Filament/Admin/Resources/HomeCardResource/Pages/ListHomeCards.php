<?php

namespace App\Filament\Admin\Resources\HomeCardResource\Pages;

use App\Filament\Admin\Resources\HomeCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeCards extends ListRecords
{
    protected static string $resource = HomeCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
