<?php

namespace App\Filament\Imports;

use App\Models\Kumanya;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class KumanyaImport extends Importer
{
    protected static ?string $model = Kumanya::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('item_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('quantity')
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('distribution_date')
                ->rules(['date']),
            ImportColumn::make('recipient')
                ->rules(['required', 'max:255']),
            ImportColumn::make('notes')
                ->rules(['max:255']),
            ImportColumn::make('amount')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ?Kumanya
    {
        // Veritabanında mevcut bir kaydı güncellemek için kullanılabilir.
        // Örneğin: 'recipient' alanına göre eşleşme yapılabilir.
        return new Kumanya();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your kumanya import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
