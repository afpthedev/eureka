<?php

namespace App\Filament\Resources\OrphanResource\Pages;

use App\Filament\Imports\EducationSupportImporter;
use App\Filament\Imports\OrphanImporter;
use App\Filament\Resources\KurbanResource\Widgets\KurbanStatsOverview;
use App\Filament\Resources\OrphanResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListOrphans extends ListRecords
{
    protected static string $resource = OrphanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(OrphanImporter::class),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrphanResource\Widgets\OrphanStatsOverview::class,
        ];
    }
}
