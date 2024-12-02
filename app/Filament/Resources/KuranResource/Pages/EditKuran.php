<?php

namespace App\Filament\Resources\KuranResource\Pages;

use App\Filament\Resources\KuranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKuran extends EditRecord
{
    protected static string $resource = KuranResource::class;
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
