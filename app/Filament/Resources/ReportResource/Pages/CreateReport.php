<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;

    protected function getRedirectUrl(): string
    {
        // Kayıt işleminden sonra List Kurban sayfasına yönlendirme
        return $this->getResource()::getUrl('index');
    }
}
