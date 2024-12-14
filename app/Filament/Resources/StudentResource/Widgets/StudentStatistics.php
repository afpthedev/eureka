<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentStatistics extends ChartWidget
{
    protected static ?string $heading = 'Talabelerimizde Cinsiyet Dağılımı';

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        // Gender bazlı veriyi gruplandır ve say
        $genderCounts = Student::select('gender', DB::raw('COUNT(*) as count'))
            ->groupBy('gender')
            ->pluck('count', 'gender');

        return [
            'labels' => [
                'Kız',
                'Erkek',
            ],
            'datasets' => [
                [
                    'label' => 'Cinsiyet Dağılımı',
                    'data' => [
                        $genderCounts['Kız'] ?? 0,
                        $genderCounts['Erkek'] ?? 0,
                    ],
                    'backgroundColor' => [
                        '#FF6384', // Kız için renk
                        '#36A2EB', // Erkek için renk
                    ],
                ],
            ],
        ];
    }
}

