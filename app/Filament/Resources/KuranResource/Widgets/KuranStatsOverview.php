<?php

namespace App\Filament\Resources\KuranResource\Widgets;

use App\Models\Hafiz;
use App\Models\Kuran;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KuranStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Water Wells', Kuran::count())
                ->description('All-time')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),
        ];
    }
}
