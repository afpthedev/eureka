<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaterWellResource\Pages;
use App\Models\WaterWell;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class WaterWellResource extends Resource
{
    protected static ?string $model = WaterWell::class;

    protected static ?string $navigationGroup = 'Projeler';

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';
    protected static ?string $navigationLabel = 'Su Kuyusu';
    protected static ?string $pluralLabel = 'Su Kuyuları';
    protected static ?string $label = 'Su Kuyusu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('location')
                    ->label('Konum')
                    ->required(),
                TextInput::make('sponsor_name')
                    ->label('Sponsor Adı')
                    ->nullable(),
                DatePicker::make('completion_date')
                    ->label('Tamamlanma Tarihi')
                    ->nullable(),
                Textarea::make('notes')
                    ->label('Notlar')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('location')
                    ->label('Konum')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sponsor_name')
                    ->label('Sponsor Adı')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('completion_date')
                    ->label('Tamamlanma Tarihi')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Ödendi' => 'Ödendi',
                        'Ödenmedi' => 'Ödenmedi',
                    ])], layout: FiltersLayout::Modal)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // İlişkiler buraya eklenebilir
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWaterWells::route('/'),
            'create' => Pages\CreateWaterWell::route('/create'),
            'edit' => Pages\EditWaterWell::route('/{record}/edit'),
        ];
    }
}
