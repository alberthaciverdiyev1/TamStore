<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Ümumi';
    protected static ?int $navigationSort = 18;
    protected static ?string $modelLabel = 'Təklif';
    protected static ?string $pluralModelLabel = 'Təkliflər qutusu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Ad Soyad'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Email'),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->label('Telefon'),
                Forms\Components\TextInput::make('position')
                    ->maxLength(255)
                    ->label('Vəzifə'),
                Forms\Components\TextInput::make('company_name')
                    ->maxLength(255)
                    ->label('Şirkət Adı'),
                Forms\Components\TextInput::make('field_of_activity')
                    ->maxLength(255)
                    ->label('Fəaliyyət Sahəsi'),
                Forms\Components\TextInput::make('subject')
                    ->maxLength(255)
                    ->label('Mövzu'),
                Forms\Components\Textarea::make('message')
                    ->columnSpanFull()
                    ->label('Mesaj'),
                Forms\Components\TextInput::make('file')
                    ->label('Fayl')
                    ->columnSpanFull()
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(fn ($record) => $record->file ? basename($record->file) : '-')
                    ->suffixAction(
                        fn ($record): ?Forms\Components\Actions\Action => $record->file
                            ? Forms\Components\Actions\Action::make('download')
                                ->icon('heroicon-o-arrow-down-tray')
                                ->url(asset('storage/' . $record->file), shouldOpenInNewTab: true)
                            : null
                    ),
                Forms\Components\Toggle::make('is_read')
                    ->label('Oxunub'),
                Forms\Components\Select::make('type')
                    ->label('Növ')
                    ->options([
                        'contact' => 'Əlaqə',
                        'partner' => 'Tərəfdaş',
                    ])
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
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
                Tables\Columns\TextColumn::make('subject')
                    ->label('Mövzu')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Oxunub')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Növ')
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'contact' => 'Əlaqə',
                        'partner' => 'Tərəfdaş',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'contact' => 'info',
                        'partner' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('file')
                    ->label('Fayl')
                    ->formatStateUsing(fn ($state) => $state ? basename($state) : '-')
                    ->icon('heroicon-o-paper-clip')
                    ->url(fn ($record) => $record->file ? asset('storage/' . $record->file) : null, shouldOpenInNewTab: true)
                    ->visibleFrom('md'),
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
                Tables\Filters\SelectFilter::make('type')
                    ->label('Növ')
                    ->options([
                        'contact' => 'Əlaqə',
                        'partner' => 'Tərəfdaş',
                    ]),
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
            'index' => Pages\ListContacts::route('/'),
        ];
    }
}
