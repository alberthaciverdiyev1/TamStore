<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Filament\Admin\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $this->record->filterOptions()->sync($this->data['filterOptions'] ?? []);

        $newImages = array_values($this->data['upload_images'] ?? []);
        $oldImages = $this->record->images()->pluck('image')->toArray();

        // Remove images that are no longer in the list
        $toRemove = array_diff($oldImages, $newImages);
        if (!empty($toRemove)) {
            $this->record->images()->whereIn('image', $toRemove)->delete();
            foreach ($toRemove as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        // Add new images
        $toAdd = array_diff($newImages, $oldImages);
        $maxSort = $this->record->images()->max('sort_order') ?? -1;
        foreach (array_values($toAdd) as $index => $path) {
            $this->record->images()->create([
                'image' => $path,
                'sort_order' => $maxSort + 1 + $index,
            ]);
        }

        // Update sort order for all current images
        foreach ($newImages as $index => $path) {
            $this->record->images()->where('image', $path)->update(['sort_order' => $index]);
        }
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['tags']) && is_array($data['tags'])) {
            if (isset($data['tags']['az'])) {
                $az = $data['tags']['az'] ?? [];
                $en = $data['tags']['en'] ?? [];
                $ru = $data['tags']['ru'] ?? [];
                $count = max(count($az), count($en), count($ru));
                $converted = [];
                for ($i = 0; $i < $count; $i++) {
                    $converted[] = [
                        'icon' => null,
                        'az' => $az[$i] ?? '',
                        'en' => $en[$i] ?? '',
                        'ru' => $ru[$i] ?? '',
                    ];
                }
                $data['tags'] = $converted;
            } elseif (!empty($data['tags']) && !isset($data['tags'][0]['az'])) {
                $data['tags'] = array_map(fn ($tag) => ['icon' => null, 'az' => is_string($tag) ? $tag : '', 'en' => '', 'ru' => ''], $data['tags']);
            }
        }

        $data['filterOptions'] = $this->record->filterOptions->pluck('id')->toArray();
        $data['upload_images'] = $this->record->images()->pluck('image')->toArray();
        return $data;
    }
}
