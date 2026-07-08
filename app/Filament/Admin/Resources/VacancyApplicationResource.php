<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VacancyApplicationResource\Pages;
use App\Models\VacancyApplication;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VacancyApplicationResource extends Resource
{
    protected static ?string $model = VacancyApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Karyera';
    protected static ?int $navigationSort = 19;
    protected static ?string $modelLabel = 'Vakansiya müraciəti';
    protected static ?string $pluralModelLabel = 'Vakansiya müraciətləri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('vacancy.name')
                    ->label('Vakansiya')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file')
                    ->label('Fayl')
                    ->formatStateUsing(fn ($state) => $state ? basename($state) : '-')
                    ->icon('heroicon-o-paper-clip')
                    ->url(fn ($record) => $record->file ? asset('storage/' . $record->file) : null, shouldOpenInNewTab: true)
                    ->visibleFrom('md'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Müraciət Tarixi')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListVacancyApplications::route('/'),
        ];
    }
}
