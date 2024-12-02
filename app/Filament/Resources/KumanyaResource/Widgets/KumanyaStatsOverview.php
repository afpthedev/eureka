<?php

namespace App\Filament\Resources\KumanyaResource\Widgets;

use App\Models\Kumanya;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KumanyaStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Kumanya Donations', Kumanya::count())
                ->description('All-time')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

            Card::make('Total Kumanya Donation Amount', '$' . number_format(Kumanya::sum('amount'), 2))
                ->description('All-time')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('primary'),

            Card::make('Average Kumanya Donation Amount', '$' . number_format(Kumanya::avg('amount'), 2))
                ->description('All-time')
                ->descriptionIcon('heroicon-s-chart-bar')
                ->color('warning'),
        ];
    }
}
