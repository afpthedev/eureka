<?php

namespace App\Filament\Resources\KumanyaResource\Pages;

use App\Filament\Imports\KumanyaImport;
use App\Filament\Resources\KumanyaResource;
use App\Filament\Resources\KumanyaResource\Widgets\KumanyaStatsOverview;
use Filament\Actions\ImportAction;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKumanyas extends ListRecords
{
    protected static string $resource = KumanyaResource::class;

    protected function getActions(): array
    {
        return [

        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Kumanya Donations from CSV')
                ->importer(KumanyaImport::class),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            KumanyaStatsOverview::class,
        ];
    }



}
