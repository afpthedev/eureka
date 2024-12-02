<?php

namespace App\Filament\Imports;

use App\Models\Kurban;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class KurbanImporter extends Importer
{
    protected static ?string $model = Kurban::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('donor_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('animal_type')
                ->rules(['required', 'max:255']),
            ImportColumn::make('sacrifice_date')
                ->rules(['date']),
            ImportColumn::make('amount')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ?Kurban
    {
        // Veritabanında mevcut bir kaydı güncellemek için kullanılabilir.
        // Örneğin: 'donor_name' alanına göre eşleşme yapılabilir.
        return new Kurban();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your kurban import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
