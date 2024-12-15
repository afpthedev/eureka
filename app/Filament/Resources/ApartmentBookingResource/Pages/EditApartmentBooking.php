<?php

namespace App\Filament\Resources\ApartmentBookingResource\Pages;

use App\Filament\Resources\ApartmentBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApartmentBooking extends EditRecord
{
    protected static string $resource = ApartmentBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Kayıt işleminden sonra List Kurban sayfasına yönlendirme
        return $this->getResource()::getUrl('index');
    }
}
