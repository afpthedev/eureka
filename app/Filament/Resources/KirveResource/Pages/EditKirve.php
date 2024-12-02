<?php

namespace App\Filament\Resources\KirveResource\Pages;

use App\Filament\Resources\KirveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKirve extends EditRecord
{
    protected static string $resource = KirveResource::class;

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
