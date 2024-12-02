<?php

namespace App\Filament\Resources\HijabScarfSupportResource\Pages;

use App\Filament\Resources\HijabScarfSupportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHijabScarfSupport extends EditRecord
{
    protected static string $resource = HijabScarfSupportResource::class;
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
