<?php

namespace App\Filament\Resources\RahleResource\Pages;

use App\Filament\Imports\EducationSupportImporter;
use App\Filament\Imports\RahleImporter;
use App\Filament\Resources\KurbanResource\Widgets\KurbanStatsOverview;
use App\Filament\Resources\RahleResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListRahles extends ListRecords
{
    protected static string $resource = RahleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(RahleImporter::class),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RahleResource\Widgets\RahleStatsOverview::class,
        ];
    }


}
