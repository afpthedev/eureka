<?php

namespace App\Filament\Resources\EducationSupportResource\Widgets;

use App\Models\EducationSupport;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EducationSupportStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Water Wells', EducationSupport::count())
                ->description('All-time')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('success'),
        ];
    }
}
