<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VacancyResource\Pages;
use App\Models\Vacancy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VacancyResource extends Resource
{
    protected static ?string $model = Vacancy::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Karyera';
    protected static ?int $navigationGroupSort = 4;
    protected static ?int $navigationSort = 14;
    protected static ?string $modelLabel = 'Vakansiya';
    protected static ?string $pluralModelLabel = 'Vakansiyalar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Vəzifə Adı'),
                        Forms\Components\TextInput::make('salary')
                            ->maxLength(255)
                            ->label('Maaş'),
                        Forms\Components\TextInput::make('city')
                            ->maxLength(255)
                            ->label('Şəhər'),
                        Forms\Components\Select::make('work_type')
                            ->label('İş Rejimi')
                            ->options([
                                'full_time' => 'Tam ştat',
                                'part_time' => 'Yarım ştat',
                                'remote' => 'Remote',
                                'hybrid' => 'Hybrid',
                                'freelance' => 'Frilans',
                            ])
                            ->native(false),
                        Forms\Components\DatePicker::make('application_deadline')
                            ->label('Son Müraciət Tarixi'),
                        Forms\Components\Toggle::make('status')
                            ->required()
                            ->default(true)
                            ->label('Status'),
                    ])
                    ->columns(2),
                Forms\Components\RichEditor::make('description')
                    ->label('İş Haqqında Məlumat')
                    ->columnSpanFull()
                  ,
                Forms\Components\RichEditor::make('requirements')
                    ->label('Tələblər')
                    ->columnSpanFull()
                    ,
                Forms\Components\Repeater::make('advantages')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->required()
                            ->label('Başlıq'),
                        Forms\Components\TextInput::make('value')
                            ->required()
                            ->label('Məzmun'),
                    ])
                    ->label('Üstünlüklərimiz')
                    ->columns(2)
                    ->columnSpanFull()
                    ->addActionLabel('Üstünlük əlavə et'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Vəzifə Adı')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('salary')
                    ->label('Maaş')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Şəhər')
                    ->searchable(),
                Tables\Columns\TextColumn::make('work_type')
                    ->label('İş Rejimi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'full_time' => 'Tam ştat',
                        'part_time' => 'Yarım ştat',
                        'remote' => 'Remote',
                        'hybrid' => 'Hybrid',
                        'freelance' => 'Frilans',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'full_time' => 'success',
                        'part_time' => 'warning',
                        'remote' => 'info',
                        'hybrid' => 'gray',
                        'freelance' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('applications_count')
                    ->label('Müraciətlər')
                    ->counts('applications')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('application_deadline')
                    ->label('Son Müraciət')
                    ->date()
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
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Silinmə Tarixi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('work_type')
                    ->label('İş Rejimi')
                    ->options([
                        'full_time' => 'Tam ştat',
                        'part_time' => 'Yarım ştat',
                        'remote' => 'Remote',
                        'hybrid' => 'Hybrid',
                        'freelance' => 'Frilans',
                    ]),
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
            'index' => Pages\ListVacancies::route('/'),
            'create' => Pages\CreateVacancy::route('/create'),
            'edit' => Pages\EditVacancy::route('/{record}/edit'),
        ];
    }
}
