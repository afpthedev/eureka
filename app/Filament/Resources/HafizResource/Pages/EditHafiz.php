<?php

namespace App\Filament\Resources\HafizResource\Pages;

use App\Filament\Resources\HafizResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHafiz extends EditRecord
{
    protected static string $resource = HafizResource::class;
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
