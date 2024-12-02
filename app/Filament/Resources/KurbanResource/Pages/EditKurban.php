<?php

namespace App\Filament\Resources\KurbanResource\Pages;

use App\Filament\Resources\KurbanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKurban extends EditRecord
{
    protected static string $resource = KurbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
}
