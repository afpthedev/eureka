<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KuranResource\Pages;
use App\Models\Kuran;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class KuranResource extends Resource
{
    protected static ?string $model = Kuran::class;

    protected static ?string $navigationGroup = 'Projeler';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Kuranı Kerim';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('sura_number')->label('Sura Numarası')->required()->numeric(),
                TextInput::make('sura_name')->label('Sura Adı')->required(),
                TextInput::make('ayah_number')->label('Ayet Numarası')->required()->numeric(),
                Textarea::make('text')->label('Ayet Metni')->required(),
                TextInput::make('amount')
                    ->label('Bağış Miktarı')
                    ->default(50) // Varsayılan değer 50
                    ->disabled(), // Kullanıcı bu alanı değiştiremesin
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sura_number')->label('Sura Numarası')->sortable()->searchable(),
                TextColumn::make('sura_name')->label('Sura Adı')->sortable()->searchable(),
                TextColumn::make('ayah_number')->label('Ayet Numarası')->sortable(),
                TextColumn::make('text')->label('Ayet Metni')->limit(50)->sortable(),
                TextColumn::make('amount')->label('Bağış Miktarı')->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Ödendi' => 'Ödendi',
                        'Ödenmedi' => 'Ödenmedi',
                    ])], layout: FiltersLayout::Modal)
            ->actions([Tables\Actions\ViewAction::make(), Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKurans::route('/'),
            'create' => Pages\CreateKuran::route('/create'),
            'edit' => Pages\EditKuran::route('/{record}/edit'),
        ];
    }
}
