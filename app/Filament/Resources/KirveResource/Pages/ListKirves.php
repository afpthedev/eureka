<?php

namespace App\Filament\Resources\KirveResource\Pages;

use App\Filament\Imports\EducationSupportImporter;
use App\Filament\Imports\KirveImporter;
use App\Filament\Resources\KirveResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListKirves extends ListRecords
{
    protected static string $resource = KirveResource::class;
    protected function getHeaderWidgets(): array
    {
        return [
            KirveResource\Widgets\KirveStatsOverview::class,

        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(KirveImporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
