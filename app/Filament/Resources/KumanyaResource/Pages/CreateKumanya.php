<?php

namespace App\Filament\Resources\KumanyaResource\Pages;

use App\Filament\Resources\KumanyaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKumanya extends CreateRecord
{
    protected static string $resource = KumanyaResource::class;

    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
}
