<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'İdarəetmə Paneli';
    protected static ?string $navigationGroup = 'Ümumi';
    protected static ?int $navigationGroupSort = 0;
    protected static ?int $navigationSort = 1;
}
