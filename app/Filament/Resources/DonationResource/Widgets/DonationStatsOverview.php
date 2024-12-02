<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Donation;

class DonationStatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = '10s';

    protected static bool $isLazy = false;
    protected function getCards(): array
    {
        return [
            Card::make('Total Donations', Donation::count())
                ->description('All-time')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

            Card::make('Total Donation Amount', '$' . number_format(Donation::sum('amount'), 2))
                ->description('All-time')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('primary'),

            Card::make('Average Donation Amount', '$' . number_format(Donation::avg('amount'), 2))
                ->description('All-time')
                ->descriptionIcon('heroicon-s-chart-bar')
                ->color('warning'),
        ];
    }
}
