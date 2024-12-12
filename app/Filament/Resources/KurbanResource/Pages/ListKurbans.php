<?php

namespace App\Filament\Resources\KurbanResource\Pages;

use App\Filament\Resources\KurbanResource;
use App\Filament\Resources\KurbanResource\Widgets\KurbanStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKurbans extends ListRecords
{
    protected static string $resource = KurbanResource::class;
    protected static ?string $title = 'Kurban Bağışları';

    protected function getHeaderActions(): array
    {
        return [
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
