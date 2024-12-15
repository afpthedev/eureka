<?php

namespace App\Filament\Resources\ApartmentBookingResource\Pages;

use App\Filament\Resources\ApartmentBookingResource;
use App\Filament\Resources\KurbanResource\Widgets\KurbanStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApartmentBookings extends ListRecords
{
    protected static string $resource = ApartmentBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
           ApartmentBookingResource\Widgets\ApartmentCalendarWidget::class,
        ];
    }

}
