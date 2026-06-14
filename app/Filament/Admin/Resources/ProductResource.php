<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\FilterOption;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $modelLabel = 'Məhsul';
    protected static ?string $pluralModelLabel = 'Məhsullar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tərcümələr')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('AZ')
                            ->schema([
                                Forms\Components\TextInput::make('name.az')
                                    ->required()
                                    ->label('Ad (AZ)')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($set, $state, $livewire) {
                                        $slug = str($state)
                                            ->replace(['ə', 'Ə', 'ü', 'Ü', 'ö', 'Ö', 'ğ', 'Ğ', 'ş', 'Ş', 'ç', 'Ç', 'ı', 'İ'], ['e', 'E', 'u', 'U', 'o', 'O', 'g', 'G', 's', 'S', 'c', 'C', 'i', 'I'])
                                            ->slug('-');
                                        $baseSlug = $slug;
                                        $attempt = 0;
                                        $recordId = $livewire instanceof \Filament\Resources\Pages\EditRecord ? $livewire->record?->id : null;
                                        while (\App\Models\Product::where('slug', $slug)->when($recordId, fn($q) => $q->where('id', '!=', $recordId))->exists() && $attempt < 10) {
                                            $slug = $baseSlug . '-' . rand(100, 999);
                                            $attempt++;
                                        }
                                        $set('slug', $slug);
                                    }),
                                Forms\Components\Hidden::make('slug'),
                                Forms\Components\Textarea::make('short_description.az')
                                    ->label('Qısa Açıqlama (AZ)')
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('description.az')
                                    ->label('Açıqlama (AZ)')
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\TextInput::make('name.en')
                                    ->label('Name (EN)'),
                                Forms\Components\Textarea::make('short_description.en')
                                    ->label('Short Description (EN)')
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('description.en')
                                    ->label('Description (EN)')
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\TextInput::make('name.ru')
                                    ->label('Название (RU)'),
                                Forms\Components\Textarea::make('short_description.ru')
                                    ->label('Краткое Описание (RU)')
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('description.ru')
                                    ->label('Описание (RU)')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('tags')
                    ->label('Teqlər')
                    ->schema([
                        \Guava\FilamentIconPicker\Forms\IconPicker::make('icon')
                            ->label('Icon')
                            ->columns(4)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('az')
                            ->label('AZ')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('en')
                            ->label('EN')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('ru')
                            ->label('RU')
                            ->columnSpan(1),
                    ])
                    ->columns(4)
                    ->addActionLabel('Tag əlavə et')
                    ->defaultItems(0)
                    ->reorderable()
                    ->columnSpanFull(),
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Category $record) => $record->name['az'] ?? $record->name['en'] ?? '')
                            ->required()
                            ->label('Kateqoriya')
                            ->preload()
                            ->searchable()
                            ->live(),
                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->required()
                            ->label('Brend')
                            ->preload()
                            ->searchable(),
                    ])
                    ->columns(3),
                Forms\Components\Select::make('filterOptions')
                    ->multiple()
                    ->label('Filter Seçimləri')
                    ->options(function ($get) {
                        $categoryId = $get('category_id');
                        if (!$categoryId) return [];

                        return FilterOption::whereHas('filter.categories', fn($q) => $q->where('categories.id', $categoryId))
                            ->with('filter')
                            ->get()
                            ->mapWithKeys(fn ($option) => [
                                $option->id => ($option->filter->name['az'] ?? '') . ': ' . ($option->value['az'] ?? $option->value['en'] ?? '')
                            ])
                            ->toArray();
                    })
                    ->visible(fn ($get) => !is_null($get('category_id'))),
                Forms\Components\FileUpload::make('upload_images')
                    ->multiple()
                    ->image()
                    ->label('Şəkillər')
                    ->columnSpanFull()
                    ->maxFiles(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad')
                    ->searchable(query: fn ($query, $search) => $query->where('name->az', 'like', "%{$search}%"))
                    ->limit(40)
                    ->getStateUsing(fn ($record) => is_array($record->name) ? ($record->name['az'] ?? '') : (is_string($record->name) ? (json_decode($record->name, true)['az'] ?? $record->name) : $record->name)),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kateqoriya')
                    ->getStateUsing(fn ($record) => $record->category?->name ? (is_array($record->category->name) ? ($record->category->name['az'] ?? '') : (is_string($record->category->name) ? (json_decode($record->category->name, true)['az'] ?? $record->category->name) : $record->category->name)) : '')
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brend')
                    ->sortable(),
                Tables\Columns\TextColumn::make('images_count')
                    ->label('Şəkillər')
                    ->counts('images')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('view_count')
                    ->label('Baxış')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Yaradılma Tarixi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Yenilənmə Tarixi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Silinmə Tarixi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kateqoriya')
                    ->relationship('category', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Category $record) => $record->name['az'] ?? $record->name['en'] ?? '')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('brand_id')
                    ->label('Brend')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
