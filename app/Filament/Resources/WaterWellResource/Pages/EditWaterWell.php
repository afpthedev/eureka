<?php

namespace App\Filament\Resources\WaterWellResource\Pages;

use App\Filament\Resources\WaterWellResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaterWell extends EditRecord
{
    protected static string $resource = WaterWellResource::class;
    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
