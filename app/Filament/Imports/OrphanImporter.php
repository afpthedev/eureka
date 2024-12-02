<?php

namespace App\Filament\Imports;

use App\Models\EducationSupport;
use App\Models\Hafiz;
use App\Models\HijabSupport;
use App\Models\Kuran;
use App\Models\Orphan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class OrphanImporter extends Importer
{
    protected static ?string $model = Orphan::class;

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

    public function resolveRecord(): ?Orphan
    {
        return new Orphan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your Orphan import has completed and ' . number_format($import->successful_rows) . ' rows were imported.';
        return $body;
    }
}
