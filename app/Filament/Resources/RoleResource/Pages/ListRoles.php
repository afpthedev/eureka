<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected static string $resource = RoleResource::class;
}