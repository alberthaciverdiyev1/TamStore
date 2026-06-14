<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Filament\Admin\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        $this->record->filterOptions()->sync($this->data['filterOptions'] ?? []);

        foreach (array_values($this->data['upload_images'] ?? []) as $index => $image) {
            $this->record->images()->create([
                'image' => $image,
                'sort_order' => $index,
            ]);
        }
    }
}
