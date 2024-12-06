<?php

namespace App\Filament\Resources\KurbanResource\Pages;

use App\Filament\Resources\KurbanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKurban extends CreateRecord
{
    protected static string $resource = KurbanResource::class;

    protected function getRedirectUrl(): string
    {
        // Kayıt işleminden sonra List Kurban sayfasına yönlendirme
        return $this->getResource()::getUrl('index');
    }
}
