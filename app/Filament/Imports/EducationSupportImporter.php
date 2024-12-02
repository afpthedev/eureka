<?php

namespace App\Filament\Imports;

use App\Models\EducationSupport;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;

class EducationSupportImporter
{
    protected static ?string $model = EducationSupport::class;

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

    public function resolveRecord(): ?EducationSupport
    {
        return new EducationSupport();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your Education Support import has completed and ' . number_format($import->successful_rows) . ' rows were imported.';
        return $body;
    }
}
