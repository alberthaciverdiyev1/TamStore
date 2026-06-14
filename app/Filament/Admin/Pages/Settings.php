<?php

namespace App\Filament\Admin\Pages;

use Filament\Forms\Components\RichEditor;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;
use Filament\Support\Enums\IconPosition;

class Settings extends BaseSettings
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Tənzimləmələr';
    protected static ?string $title = 'Sistem Tənzimləmələri';

    public function schema(): array
    {
        return [
            Tabs::make('Settings')
                ->tabs([
                    Tabs\Tab::make('Əlaqə')
                        ->icon('heroicon-m-map-pin')
                        ->schema([

                            TextInput::make('contact.phone')
                                ->label('Telefon')
                                ->tel()
                                ->placeholder('+994 (XX) XXX-XX-XX')
                                ->prefixIcon('heroicon-m-phone')
                                ->prefixIconColor('primary'),

                            TextInput::make('contact.email')
                                ->label('Email')
                                ->email()
                                ->placeholder('info@tamstore.az')
                                ->prefixIcon('heroicon-m-envelope')
                                ->prefixIconColor('primary'),

                            TextInput::make('app.google_play_link')
                                ->label('Google Play Link')
                                ->prefixIcon('heroicon-m-clock')
                                ->prefixIconColor('info'),

                            TextInput::make('app.app_store_link')
                                ->label('App Store Link')
                                ->prefixIcon('heroicon-m-clock')
                                ->prefixIconColor('info'),

                            Textarea::make('contact.google_map')
                                ->label('Google Xəritə Linki (Iframe)')
                                ->placeholder('<iframe src="https://www.google.com/maps/embed?..." ...></iframe>')
                                ->rows(2)
                                ->columnSpanFull(),

                        ]),

                    Tabs\Tab::make('Sosial Media')
                        ->icon('heroicon-m-globe-alt')
                        ->schema([

                            Grid::make(3)
                                ->schema([
                                    TextInput::make('social.instagram')
                                        ->label('Instagram')
                                        ->prefix('instagram.com/')
                                        ->placeholder('istifadeci_adi')
                                        ->prefixIcon('heroicon-m-camera')
                                        ->prefixIconColor('danger')
                                        ->extraInputAttributes(['style' => 'border-color: rgba(239, 68, 68, 0.5)']),

                                    TextInput::make('social.facebook')
                                        ->label('Facebook')
                                        ->prefix('facebook.com/')
                                        ->placeholder('sehife_adi')
                                        ->prefixIcon('heroicon-m-user-group')
                                        ->prefixIconColor('info')
                                        ->extraInputAttributes(['style' => 'border-color: rgba(14, 165, 233, 0.5)']),


                                    TextInput::make('social.youtube')
                                        ->label('Youtube')
                                        ->prefix('youtube.com/')
                                        ->placeholder('sehife_adi')
                                        ->prefixIcon('heroicon-m-user-group')
                                        ->prefixIconColor('info')
                                        ->extraInputAttributes(['style' => 'border-color: rgba(14, 165, 233, 0.5)']),


                                    TextInput::make('social.tiktok')
                                        ->label('TikTok')
                                        ->prefix('tiktok.com/')
                                        ->placeholder('sehife_adi')
                                        ->prefixIcon('heroicon-m-user-group')
                                        ->prefixIconColor('info')
                                        ->extraInputAttributes(['style' => 'border-color: rgba(14, 165, 233, 0.5)']),
                                ]),
                        ]),

                    Tabs\Tab::make('Statistika')
                        ->icon('heroicon-m-globe-alt')
                        ->schema([

                            Grid::make(3)
                                ->schema([
                                    TextInput::make('statistic.branch')
                                        ->label('Filial')
                                        ->placeholder('45'),

                                    TextInput::make('statistic.employee')
                                        ->label('Əmekdas')
                                        ->placeholder('1200'),


                                    TextInput::make('statistic.customer')
                                        ->label('Sadiq musteri')
                                        ->placeholder('1200'),

                                    TextInput::make('statistic.product')
                                        ->label('Mehsul Cesidi')
                                        ->placeholder('1200'),
                                ]),
                        ]),

                    Tabs\Tab::make('Kodlar')
                        ->icon('heroicon-m-code-bracket-square')
                        ->schema([

                            Textarea::make('scripts.header')
                                ->label('Header')
                                ->placeholder('<script> // Google Analytics kodu bura </script>')
                                ->rows(4)
                                ->extraInputAttributes(['style' => 'font-family: monospace; background: #1a1a1a; color: #00ff00;']),

                            Textarea::make('scripts.body')
                                ->label('Body')
                                ->placeholder('<noscript> // Tag Manager noscript kodu </noscript>')
                                ->rows(4)
                                ->extraInputAttributes(['style' => 'font-family: monospace; background: #1a1a1a; color: #00ff00;']),

                            Textarea::make('scripts.footer')
                                ->label('Footer')
                                ->placeholder('<script> // Footer script kodlari </script>')
                                ->rows(4)
                                ->extraInputAttributes(['style' => 'font-family: monospace; background: #1a1a1a; color: #00ff00;']),
                        ]),

                    Tabs\Tab::make('Məxfilik siyasəti')
                        ->icon('heroicon-m-shield-check')
                        ->schema([
                            RichEditor::make('privacy.az')
                                ->label('AZ Versiyası')
                                ->required(),

                            RichEditor::make('privacy.en')
                                ->label('EN Version'),

                            RichEditor::make('privacy.ru')
                                ->label('RU Версия'),
                        ]),
                    Tabs\Tab::make('İstifadə şərtləri')
                        ->icon('heroicon-m-shield-check')
                        ->schema([
                            RichEditor::make('terms.az')
                                ->label('AZ Versiyası')
                                ->required(),

                            RichEditor::make('terms.en')
                                ->label('EN Version'),

                            RichEditor::make('terms.ru')
                                ->label('RU Версия'),
                        ]),

                    Tabs\Tab::make('Haqqımızda')
                        ->icon('heroicon-m-information-circle')
                        ->schema([
                            FileUpload::make('big_team_image')
                                ->label('Big Team Image')
                                ->required(),

                            FileUpload::make('small_team_image')
                                ->label('Small Team Image')
                                ->required(),

                            RichEditor::make('about.az')
                                ->label('AZ Versiyası')
                                ->required(),

                            RichEditor::make('about.en')
                                ->label('EN Version'),

                            RichEditor::make('about.ru')
                                ->label('RU Версия'),
                        ]),
                ])
                ->columnSpanFull()
                ->persistTabInQueryString(),
        ];
    }
}
