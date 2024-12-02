<?php

namespace App\Filament\Resources\KurbanResource\Pages;

use App\Filament\Exports\KurbanExporter;
use App\Filament\Imports\KuranImporter;
use App\Filament\Imports\KurbanImporter;
use App\Filament\Resources\KurbanResource;
use App\Filament\Resources\KurbanResource\Widgets\KurbanStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;


class ListKurbans extends ListRecords
{
    protected static string $resource = KurbanResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label('Export Kurban Data')
                ->exporter(KurbanExporter::class) // Export sütunlarını burada tanımlıyoruz
                ->fileName('kurban_data.csv'), // Dosya adı ayarlama
            Actions\ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(KurbanImporter::class),
            Actions\CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
            KurbanStatsOverview::class,
        ];
    }

}
