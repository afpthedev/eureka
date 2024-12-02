<?php

namespace App\Filament\Resources\KirveResource\Widgets;

use App\Models\Hafiz;
use App\Models\Kirve;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KirveStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Water Wells', Kirve::count())
                ->description('All-time')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('success'),
        ];
    }
}
