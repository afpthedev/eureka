<?php

namespace App\Filament\Resources\KumanyaResource\Pages;

use App\Filament\Resources\KumanyaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKumanya extends EditRecord
{
    protected static string $resource = KumanyaResource::class;

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
