<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Resources\WidgetsResource\Widgets\StatsOverview;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?int $navigationSort = -2;

    public function getTitle(): string
    {
        // Get current hour to determine time of day
        $hour = now()->hour;
        
        if ($hour < 11) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($hour < 19) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        // Get authenticated user's name
        $userName = auth()->user()->name;

        return "$greeting, $userName!";
    }

    public function getHeaderWidgets(): array
    {
        return [
             StatsOverview::class,
        ]; 
    }

    public function getWidgets(): array
    {
        return []; // Kosongkan widget utama
    }

}