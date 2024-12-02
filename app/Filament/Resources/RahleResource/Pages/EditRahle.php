<?php

namespace App\Filament\Resources\RahleResource\Pages;

use App\Filament\Resources\RahleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRahle extends EditRecord
{
    protected static string $resource = RahleResource::class;


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
