<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FilterResource\Pages;
use App\Models\Category;
use App\Models\Filter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FilterResource extends Resource
{
    protected static ?string $model = Filter::class;

    protected static ?string $navigationIcon = 'heroicon-o-funnel';
    protected static ?string $navigationGroup = 'Məhsullar';
    protected static ?int $navigationSort = 8;
    protected static ?string $modelLabel = 'Filter';
    protected static ?string $pluralModelLabel = 'Filterlər';

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
                                    ->label('Ad (AZ)'),
                            ]),
                        Forms\Components\Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\TextInput::make('name.en')
                                    ->label('Name (EN)'),
                            ]),
                        Forms\Components\Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\TextInput::make('name.ru')
                                    ->label('Название (RU)'),
                            ]),
                    ])
                    ->columnSpanFull(),
                Forms\Components\Select::make('categories')
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Category $record) => $record->name['az'] ?? $record->name['en'] ?? '')
                    ->label('Kateqoriyalar')
                    ->preload(),
                Forms\Components\Repeater::make('filterOptions')
                    ->relationship('filterOptions')
                    ->label('Filter Seçimləri')
                    ->schema([
                        Forms\Components\Tabs::make('Option Tərcümələr')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('AZ')
                                    ->schema([
                                        Forms\Components\TextInput::make('value.az')
                                            ->required()
                                            ->label('Dəyər (AZ)'),
                                    ]),
                                Forms\Components\Tabs\Tab::make('EN')
                                    ->schema([
                                        Forms\Components\TextInput::make('value.en')
                                            ->label('Value (EN)'),
                                    ]),
                                Forms\Components\Tabs\Tab::make('RU')
                                    ->schema([
                                        Forms\Components\TextInput::make('value.ru')
                                            ->label('Значение (RU)'),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['value']['az'] ?? null)
                    ->addActionLabel('+ Seçim Əlavə Et')
                    ->reorderable()
                    ->defaultItems(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad')
                    ->searchable(query: fn ($query, $search) => $query->where('name->az', 'like', "%{$search}%"))
                    ->getStateUsing(fn ($record) => is_array($record->name) ? ($record->name['az'] ?? '') : (is_string($record->name) ? (json_decode($record->name, true)['az'] ?? $record->name) : $record->name)),
                Tables\Columns\TextColumn::make('categories')
                    ->label('Kateqoriyalar')
                    ->badge()
                    ->formatStateUsing(fn (Filter $record): string => $record->categories->map(fn ($c) => $c->name['az'] ?? $c->name['en'] ?? '')->implode(', '))
                    ->color('gray'),
                Tables\Columns\TextColumn::make('filterOptions_count')
                    ->label('Seçim Sayı')
                    ->counts('filterOptions')
                    ->sortable(),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListFilters::route('/'),
        ];
    }
}
