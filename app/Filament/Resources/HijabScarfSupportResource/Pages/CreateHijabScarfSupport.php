<?php

namespace App\Filament\Resources\HijabScarfSupportResource\Pages;

use App\Filament\Resources\HijabScarfSupportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHijabScarfSupport extends CreateRecord
{
    protected static string $resource = HijabScarfSupportResource::class;

    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
}
