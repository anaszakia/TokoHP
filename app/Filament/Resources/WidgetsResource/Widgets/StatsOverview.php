<?php

namespace App\Filament\Resources\WidgetsResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $newUsersLastMonth = User::where('created_at', '>=', now()->subMonth())->count();
        $growthPercentage = $totalUsers > 0 
            ? round(($newUsersLastMonth / $totalUsers) * 100) 
            : 0;
        return [
        Stat::make('Total Pengguna', number_format($totalUsers))
            ->icon('heroicon-o-users')
            ->description($growthPercentage . '% pertumbuhan')
            ->descriptionIcon($growthPercentage >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
            ->chart($this->getUserGrowthChartData())
            ->color($growthPercentage >= 0 ? 'success' : 'danger'),
        Stat::make('Bounce rate', '21%')
            ->description('7% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('danger'),
        Stat::make('Average time on page', '3:12')
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
        ];
    }

     protected function getUserGrowthChartData(): array
    {
        return [
            User::whereDate('created_at', now()->subDays(6))->count(),
            User::whereDate('created_at', now()->subDays(5))->count(),
            User::whereDate('created_at', now()->subDays(4))->count(),
            User::whereDate('created_at', now()->subDays(3))->count(),
            User::whereDate('created_at', now()->subDays(2))->count(),
            User::whereDate('created_at', now()->subDays(1))->count(),
            User::whereDate('created_at', now())->count(),
        ];
    }
}
