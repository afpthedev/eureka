<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KumanyaResource\Pages;
use App\Models\Kumanya;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;

class KumanyaResource extends Resource
{
    protected static ?string $model = Kumanya::class;
    protected static ?string $navigationGroup = 'Projeler';

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Kumanya Bağışları';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('item_name')->label('Ürün Adı')->required(),
                TextInput::make('quantity')->label('Miktar')->required()->numeric(),
                DatePicker::make('distribution_date')->label('Dağıtım Tarihi')->required(),
                TextInput::make('recipient')->label('Alıcı')->required(),
                TextInput::make('notes')->label('Notlar')->nullable(),
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
                TextColumn::make('item_name')->label('Ürün Adı')->sortable()->searchable(),
                TextColumn::make('quantity')->label('Miktar')->sortable(),
                TextColumn::make('distribution_date')->label('Dağıtım Tarihi')->sortable(),
                TextColumn::make('recipient')->label('Alıcı')->sortable()->searchable(),
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
            'index' => Pages\ListKumanyas::route('/'),
            'create' => Pages\CreateKumanya::route('/create'),
            'edit' => Pages\EditKumanya::route('/{record}/edit'),
        ];
    }
}
