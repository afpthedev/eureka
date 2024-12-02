<?php

namespace App\Filament\Resources\RahleResource\Pages;

use App\Filament\Resources\RahleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRahle extends CreateRecord
{
    protected static string $resource = RahleResource::class;

    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
}
