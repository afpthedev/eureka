<?php

namespace App\Filament\Resources\HafizResource\Pages;

use App\Filament\Imports\EducationSupportImporter;
use App\Filament\Imports\HafizImporter;
use App\Filament\Resources\HafizResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListHafizs extends ListRecords
{
    protected static string $resource = HafizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(HafizImporter::class),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            HafizResource\Widgets\HafizStatsOverview::class,

        ];
    }
}
