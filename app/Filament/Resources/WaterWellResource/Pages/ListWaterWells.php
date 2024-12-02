<?php

namespace App\Filament\Resources\WaterWellResource\Pages;

use App\Filament\Imports\KuranImporter;
use App\Filament\Imports\WaterWellImporter;
use App\Filament\Resources\WaterWellResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListWaterWells extends ListRecords
{
    protected static string $resource = WaterWellResource::class;


    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(WaterWellImporter::class),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            WaterWellResource\Widgets\WaterWellStatsOverview::class,
        ];
    }
}
