<?php

namespace App\Filament\Resources\HijabScarfSupportResource\Widgets;

use App\Models\EducationSupport;
use App\Models\Hafiz;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HafizStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Water Wells', Hafiz::count())
                ->description('All-time')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('success'),
        ];
    }
}
