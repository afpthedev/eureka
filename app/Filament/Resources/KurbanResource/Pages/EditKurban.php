<?php

namespace App\Filament\Resources\KurbanResource\Pages;

use App\Filament\Resources\KurbanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKurban extends EditRecord
{
    protected static string $resource = KurbanResource::class;

    /**
     * Get the header actions for the edit page.
     *
     * @return array
     */
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
