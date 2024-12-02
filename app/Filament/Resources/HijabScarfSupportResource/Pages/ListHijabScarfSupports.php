<?php

namespace App\Filament\Resources\HijabScarfSupportResource\Pages;

use App\Filament\Imports\EducationSupportImporter;
use App\Filament\Imports\HijabImporter;
use App\Filament\Resources\HijabScarfSupportResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListHijabScarfSupports extends ListRecords
{
    protected static string $resource = HijabScarfSupportResource::class;
    protected function getHeaderWidgets(): array
    {
        return [
            HijabScarfSupportResource\Widgets\HafizStatsOverview::class,

        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(HijabImporter::class),
            Actions\CreateAction::make(),
        ];
    }


}
