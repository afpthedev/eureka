<?php

namespace App\Filament\Resources\WaterWellResource\Widgets;

use App\Models\Orphan;
use App\Models\WaterWell;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WaterWellStatsOverview extends BaseWidget
{

    protected function getCards(): array
    {
        return [
            Card::make('Total Water Wells', WaterWell::count())
                ->description('All-time')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('success'),
        ];
    }
}
