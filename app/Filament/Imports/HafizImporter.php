<?php

namespace App\Filament\Imports;

use App\Models\EducationSupport;
use App\Models\Hafiz;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class HafizImporter extends Importer
{
    protected static ?string $model = Hafiz::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('first_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('last_name')
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): ?Hafiz
    {
        return new Hafiz();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your Hafiz import has completed and ' . number_format($import->successful_rows) . ' rows were imported.';
        return $body;
    }
}
