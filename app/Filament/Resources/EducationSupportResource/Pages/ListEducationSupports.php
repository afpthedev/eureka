<?php

namespace App\Filament\Resources\EducationSupportResource\Pages;

use App\Filament\Imports\DonationImporter;
use App\Filament\Imports\EducationSupportImporter;
use App\Filament\Resources\DonationResource\Widgets\DonationStatsOverview;
use App\Filament\Resources\EducationSupportResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListEducationSupports extends ListRecords
{
    protected static string $resource = EducationSupportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(EducationSupportImporter::class),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            EducationSupportResource\Widgets\EducationSupportStatsOverview::class,

        ];
    }

}
