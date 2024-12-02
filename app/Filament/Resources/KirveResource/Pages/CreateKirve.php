<?php

namespace App\Filament\Resources\KirveResource\Pages;

use App\Filament\Resources\KirveResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKirve extends CreateRecord
{
    protected static string $resource = KirveResource::class;

    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
}
