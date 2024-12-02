<?php

namespace App\Filament\Exports;

use App\Models\Kurban;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class KurbanExporter extends Exporter
{
    protected static ?string $model = Kurban::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('donor_name')
                ->label('Donor Name'), // Bağışçı Adı
            ExportColumn::make('animal_type')
                ->label('Animal Type'), // Kurban Türü
            ExportColumn::make('sacrifice_date')
                ->label('Sacrifice Date'), // Kurban Kesim Tarihi
            ExportColumn::make('amount')
                ->label('Amount'), // Bağış Miktarı
            ExportColumn::make('created_at')
                ->label('Created At'), // Oluşturulma Tarihi
            ExportColumn::make('updated_at')
                ->label('Updated At'), // Güncellenme Tarihi
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your kurban export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
