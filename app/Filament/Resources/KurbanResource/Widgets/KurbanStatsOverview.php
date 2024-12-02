<?php

namespace App\Filament\Resources\KurbanResource\Widgets;

use App\Models\Kurban;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KurbanStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Kurban Donations', Kurban::count())
                ->description('All-time')
                ->descriptionIcon('heroicon-o-gift')
                ->color('success'),

            Card::make('Total Kurban Donation Amount', '$' . number_format(Kurban::sum('amount'), 2))
                ->description('All-time')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('primary'),

            Card::make('Average Kurban Donation Amount', '$' . number_format(Kurban::avg('amount'), 2))
                ->description('All-time')
                ->descriptionIcon('heroicon-s-chart-bar')
                ->color('warning'),
        ];
    }
}
