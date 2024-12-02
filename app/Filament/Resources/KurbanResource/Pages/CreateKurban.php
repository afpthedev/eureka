<?php

namespace App\Filament\Resources\KurbanResource\Pages;

use App\Filament\Resources\KurbanResource;
use App\Models\Kurban;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateKurban extends CreateRecord
{
    protected static string $resource = KurbanResource::class;


    protected function getRedirectUrl(): string
    {
        // Bağış oluşturulduktan sonra yönlendirilecek URL
        return $this->getResource()::getUrl('index');
    }
}
