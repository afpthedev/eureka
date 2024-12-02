<?php

namespace App\Filament\Resources\HafizResource\Pages;

use App\Filament\Resources\HafizResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHafiz extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
    protected static string $resource = HafizResource::class;
}
