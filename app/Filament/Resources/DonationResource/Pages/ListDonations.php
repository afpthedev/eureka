<?php

namespace App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\Widgets\DonationStatsOverview;

use App\Filament\Imports\DonationImporter;
use App\Filament\Resources\DonationResource;
use Filament\Actions\ImportAction;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(DonationImporter::class),
            Actions\CreateAction::make(),
        ];

    }

    protected function getHeaderWidgets(): array
    {
        return [
            DonationStatsOverview::class,

        ];
    }
}
