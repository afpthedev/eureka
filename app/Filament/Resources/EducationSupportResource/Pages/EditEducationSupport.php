<?php

namespace App\Filament\Resources\EducationSupportResource\Pages;

use App\Filament\Resources\EducationSupportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationSupport extends EditRecord
{
    protected static string $resource = EducationSupportResource::class;
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
