<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HomeCardResource\Pages;
use App\Models\HomeCard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HomeCardResource extends Resource
{
    protected static ?string $model = HomeCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Ümumi';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'Ana Səhifə Kartı';
    protected static ?string $pluralModelLabel = 'Ana Səhifə Kartları';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tərcümələr')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('AZ')
                            ->schema([
                                Forms\Components\TextInput::make('title.az')
                                    ->required()
                                    ->label('Başlıq (AZ)'),
                                Forms\Components\TextInput::make('subtitle.az')
                                    ->required()
                                    ->label('Alt Başlıq (AZ)'),
                            ]),
                        Forms\Components\Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\TextInput::make('title.en')
                                    ->required()
                                    ->label('Title (EN)'),
                                Forms\Components\TextInput::make('subtitle.en')
                                    ->required()
                                    ->label('Subtitle (EN)'),
                            ]),
                        Forms\Components\Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\TextInput::make('title.ru')
                                    ->required()
                                    ->label('Заголовок (RU)'),
                                Forms\Components\TextInput::make('subtitle.ru')
                                    ->required()
                                    ->label('Подзаголовок (RU)'),
                            ]),
                    ])
                    ->columnSpanFull(),
                \Guava\FilamentIconPicker\Forms\IconPicker::make('icon')
                    ->label('İkon')
                    ->columns(4),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->label('Şəkil'),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Şəkil'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlıq')
                    ->limit(50)
                    ->getStateUsing(fn ($record) => is_array($record->title) ? ($record->title['az'] ?? '') : (is_string($record->title) ? (json_decode($record->title, true)['az'] ?? $record->title) : $record->title)),
                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean(),
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
            'index' => Pages\ListHomeCards::route('/'),
        ];
    }
}
