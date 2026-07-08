<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NewsResource\Pages;
use App\Models\News;
use App\Models\NewsCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationGroup = 'Xəbərlər';
    protected static ?int $navigationGroupSort = 3;
    protected static ?int $navigationSort = 11;
    protected static ?string $modelLabel = 'Xəbər';
    protected static ?string $pluralModelLabel = 'Xəbərlər';

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
                                Forms\Components\RichEditor::make('description.az')
                                    ->required()
                                    ->label('Məzmun (AZ)')
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\TextInput::make('title.en')
                                    ->label('Title (EN)'),
                                Forms\Components\RichEditor::make('description.en')
                                    ->label('Description (EN)')
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\TextInput::make('title.ru')
                                    ->label('Заголовок (RU)'),
                                Forms\Components\RichEditor::make('description.ru')
                                    ->label('Описание (RU)')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->getOptionLabelFromRecordUsing(fn (NewsCategory $record) => $record->name['az'] ?? $record->name['en'] ?? '')
                    ->required()
                    ->label('Kateqoriya')
                    ->preload()
                    ->searchable(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required()
                    ->label('Şəkil')
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('tags')
                    ->label('Teqlər'),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlıq')
                    ->searchable(query: fn ($query, $search) => $query->where('title->az', 'like', "%{$search}%"))
                    ->limit(50)
                    ->getStateUsing(fn ($record) => is_array($record->title) ? ($record->title['az'] ?? '') : (is_string($record->title) ? (json_decode($record->title, true)['az'] ?? $record->title) : $record->title)),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Şəkil'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kateqoriya')
                    ->getStateUsing(fn ($record) => $record->category?->name ? (is_array($record->category->name) ? ($record->category->name['az'] ?? '') : $record->category->name) : ''),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
