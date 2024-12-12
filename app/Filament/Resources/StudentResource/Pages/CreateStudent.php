<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;
    protected function getRedirectUrl(): string
    {
        // Kayıt işleminden sonra List Kurban sayfasına yönlendirme
        return $this->getResource()::getUrl('index');
    }
}
