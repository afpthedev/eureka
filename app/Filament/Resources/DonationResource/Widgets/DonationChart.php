<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use App\Models\Donation;
use App\Models\Kurban;

class DonationChart extends ChartWidget
{
    protected static ?string $heading = 'Tüm Bağış İstatistikleri';

    protected function getData(): array
    {
        // Donation bağış miktarını çekiyoruz
        $donationData = Trend::model(Donation::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('amount'); // Bağış miktarını topluyoruz

        // Kurban bağış miktarını çekiyoruz
        $kurbanData = Trend::model(Kurban::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('amount'); // Kurban bağış miktarını topluyoruz

        return [
            'datasets' => [
                [
                    'label' => 'Monthly Donations',
                    'data' => $donationData->map(fn (TrendValue $value) => $value->aggregate), // Donation verisi
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Kurban Donations',
                    'data' => $kurbanData->map(fn (TrendValue $value) => $value->aggregate), // Kurban verisi
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $donationData->map(fn (TrendValue $value) => $value->date), // Ayları göstermek için
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Sütun grafiği
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => true, // Grafik boyutlarını serbest bırakıyoruz

        ];
    }
}
