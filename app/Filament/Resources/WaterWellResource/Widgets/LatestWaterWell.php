<?php

namespace App\Filament\Resources\WaterWellResource\Widgets;

use App\Models\Kurban;
use App\Models\WaterWell;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class LatestWaterWell extends ChartWidget
{
    protected static ?string $heading = 'Kurban Bağış Trendleri';

    protected function getData(): array
    {
        // Son 7 günün tarihlerini alıyoruz
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->push(Carbon::today()->subDays($i)->format('Y-m-d'));
        }

        $bankPaymentsData = [];
        $cashPaymentsData = [];

        foreach ($dates as $date) {
            $bankPaymentsCount = Kurban::where('payment_type', 'Banka')
                ->whereDate('created_at', $date)
                ->count();

            $cashPaymentsCount = Kurban::where('payment_type', 'Nakit')
                ->whereDate('created_at', $date)
                ->count();

            $bankPaymentsData[] = $bankPaymentsCount;
            $cashPaymentsData[] = $cashPaymentsCount;
        }

        return [
            'labels' => $dates->toArray(),
            'datasets' => [
                [
                    'label' => 'Banka Ödeme',
                    'data' => $bankPaymentsData,
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'fill' => false,
                    'tension' => 0.1,
                ],
                [
                    'label' => 'Nakit Ödeme',
                    'data' => $cashPaymentsData,
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'fill' => false,
                    'tension' => 0.1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Çizgi grafik kullanıyoruz
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => true,
            'scales' => [
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Tarih',
                    ],
                ],
                'y' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Bağış Sayısı',
                    ],
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
