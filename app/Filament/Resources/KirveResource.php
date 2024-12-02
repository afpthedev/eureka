<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KirveResource\Pages;
use App\Models\Kirve;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

class KirveResource extends Resource
{
    protected static ?string $model = Kirve::class;
    protected static ?string $navigationGroup = 'Projeler';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Kirve Listesi';
    protected static ?string $pluralLabel = 'Kirveler';
    protected static ?string $label = 'Kirve';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('İsim')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('E-posta')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->label('Telefon Numarası')
                    ->required(),
                Forms\Components\Textarea::make('address')
                    ->label('Adres')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('İsim')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->label('E-posta')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone_number')->label('Telefon Numarası'),
                Tables\Columns\TextColumn::make('created_at')->label('Kayıt Tarihi')->date(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Ödendi' => 'Ödendi',
                        'Ödenmedi' => 'Ödenmedi',
                    ])], layout: FiltersLayout::Modal)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKirves::route('/'),
            'create' => Pages\CreateKirve::route('/create'),
            'edit' => Pages\EditKirve::route('/{record}/edit'),
        ];
    }
}
