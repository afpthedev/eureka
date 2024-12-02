<?php

namespace App\Filament\Resources\KuranResource\Pages;

use App\Filament\Imports\EducationSupportImporter;
use App\Filament\Imports\KuranImporter;
use App\Filament\Resources\KumanyaResource\Widgets\KumanyaStatsOverview;
use App\Filament\Resources\KuranResource;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListKurans extends ListRecords
{
    protected static string $resource = KuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(KuranImporter::class),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            KuranResource\Widgets\KuranStatsOverview::class,
        ];
    }
}
