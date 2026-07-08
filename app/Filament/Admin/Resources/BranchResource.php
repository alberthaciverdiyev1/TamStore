<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BranchResource\Pages;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Ümumi';
    protected static ?int $navigationSort = 15;
    protected static ?string $modelLabel = 'Filial';
    protected static ?string $pluralModelLabel = 'Filiallar';

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
                                Forms\Components\TextInput::make('address.az')
                                    ->label('Ünvan (AZ)'),
                            ]),
                        Forms\Components\Tabs\Tab::make('EN')
                            ->schema([
                                Forms\Components\TextInput::make('name.en')
                                    ->label('Name (EN)'),
                                Forms\Components\TextInput::make('address.en')
                                    ->label('Address (EN)'),
                            ]),
                        Forms\Components\Tabs\Tab::make('RU')
                            ->schema([
                                Forms\Components\TextInput::make('name.ru')
                                    ->label('Название (RU)'),
                                Forms\Components\TextInput::make('address.ru')
                                    ->label('Адрес (RU)'),
                            ]),
                    ])
                    ->columnSpanFull(),
                Forms\Components\TimePicker::make('working_hours_start')
                    ->label('İş Saatları Baslangic'),
                Forms\Components\TimePicker::make('working_hours_end')
                    ->label('İş Saatları Bitis'),
                Forms\Components\TextInput::make('phone_1')
                    ->label('Telefon 1')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_2')
                    ->label('Telefon 2')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lat')
                    ->label('Enlem')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('lng')
                    ->label('Uzunluq')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('zoom')
                    ->label('Zoom')
                    ->numeric()
                    ->default(15),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad')
                    ->searchable(query: fn ($query, $search) => $query->where('name->az', 'like', "%{$search}%"))
                    ->limit(50)
                    ->getStateUsing(fn ($record) => is_array($record->name) ? ($record->name['az'] ?? '') : (is_string($record->name) ? (json_decode($record->name, true)['az'] ?? $record->name) : $record->name)),
                Tables\Columns\TextColumn::make('address')
                    ->label('Ünvan')
                    ->searchable(query: fn ($query, $search) => $query->where('address->az', 'like', "%{$search}%"))
                    ->limit(50)
                    ->getStateUsing(fn ($record) => is_array($record->address) ? ($record->address['az'] ?? '') : (is_string($record->address) ? (json_decode($record->address, true)['az'] ?? $record->address) : $record->address)),
                Tables\Columns\TextColumn::make('phone_1')
                    ->label('Telefon 1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_2')
                    ->label('Telefon 2')
                    ->searchable(),
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
            'index' => Pages\ListBranches::route('/'),
        ];
    }
}
