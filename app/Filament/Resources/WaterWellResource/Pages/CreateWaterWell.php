<?php

namespace App\Filament\Resources\WaterWellResource\Pages;

use App\Filament\Resources\WaterWellResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWaterWell extends CreateRecord
{
    protected static string $resource = WaterWellResource::class;
    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
}
