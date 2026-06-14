<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BannerResource\Pages;

use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Banner';
    protected static ?string $pluralModelLabel = 'Bannerlər';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tərcümələr')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('AZ')
                            ->schema([
                                Forms\Components\TextInput::make('first_title.az')
                                    ->maxLength(255)
                                    ->label('Birinci Başlıq (AZ)'),
                                Forms\Components\TextInput::make('second_title.az')
                                    ->maxLength(255)
                                    ->label('İkinci Başlıq (AZ)'),
                                Forms\Components\TextInput::make('third_title.az')
                                    ->maxLength(255)
                                    ->label('Üçüncü Başlıq (AZ)'),
                            ]),
                        Forms\Components\Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\TextInput::make('first_title.en')
                                    ->maxLength(255)
                                    ->label('First Title (EN)'),
                                Forms\Components\TextInput::make('second_title.en')
                                    ->maxLength(255)
                                    ->label('Second Title (EN)'),
                                Forms\Components\TextInput::make('third_title.en')
                                    ->maxLength(255)
                                    ->label('Third Title (EN)'),
                            ]),
                        Forms\Components\Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\TextInput::make('first_title.ru')
                                    ->maxLength(255)
                                    ->label('Первый Заголовок (RU)'),
                                Forms\Components\TextInput::make('second_title.ru')
                                    ->maxLength(255)
                                    ->label('Второй Заголовок (RU)'),
                                Forms\Components\TextInput::make('third_title.ru')
                                    ->maxLength(255)
                                    ->label('Третий Заголовок (RU)'),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('page') === 'home'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required()
                    ->label('Şəkil'),
                Forms\Components\Toggle::make('status')
                    ->label('Status')
                    ->default(true),
                Forms\Components\Select::make('page')
                    ->label('Səhifə')
                    ->options([
                        'home' => 'Ana Səhifə',
                        'products' => 'Məhsullar',
                        'about' => 'Haqqımızda',
                        'branch' => 'Filial',
                        'partner' => 'Tərəfdaş',
                        'blog' => 'Bloq',
                        'news' => 'Xəbər',
                        'contact' => 'Əlaqə',
                        'vacancy' => 'Vakansiya',
                    ])
                    ->default('home')
                    ->native(false)
                    ->live(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_title')
                    ->label('Birinci Başlıq')
                    ->searchable(query: fn ($query, $search) => $query->where('first_title->az', 'like', "%{$search}%"))
                    ->getStateUsing(fn ($record) => is_array($record->first_title) ? ($record->first_title['az'] ?? '') : (is_string($record->first_title) ? (json_decode($record->first_title, true)['az'] ?? $record->first_title) : $record->first_title)),
                Tables\Columns\TextColumn::make('second_title')
                    ->label('İkinci Başlıq')
                    ->searchable(query: fn ($query, $search) => $query->where('second_title->az', 'like', "%{$search}%"))
                    ->getStateUsing(fn ($record) => is_array($record->second_title) ? ($record->second_title['az'] ?? '') : (is_string($record->second_title) ? (json_decode($record->second_title, true)['az'] ?? $record->second_title) : $record->second_title)),
                Tables\Columns\TextColumn::make('third_title')
                    ->label('Üçüncü Başlıq')
                    ->searchable(query: fn ($query, $search) => $query->where('third_title->az', 'like', "%{$search}%"))
                    ->getStateUsing(fn ($record) => is_array($record->third_title) ? ($record->third_title['az'] ?? '') : (is_string($record->third_title) ? (json_decode($record->third_title, true)['az'] ?? $record->third_title) : $record->third_title)),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Şəkil'),
                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('page')
                    ->label('Səhifə')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'home' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'home' => 'Ana Səhifə',
                        'products' => 'Məhsullar',
                        'about' => 'Haqqımızda',
                        'branch' => 'Filial',
                        'partner' => 'Tərəfdaş',
                        'blog' => 'Bloq',
                        'news' => 'Xəbər',
                        'contact' => 'Əlaqə',
                        'vacancy' => 'Vakansiya',
                        default => $state,
                    }),
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
            'index' => Pages\ListBanners::route('/'),
        ];
    }
}
