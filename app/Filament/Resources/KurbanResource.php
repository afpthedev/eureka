<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KurbanResource\Pages;
use App\Models\Kurban;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Table;

class KurbanResource extends Resource
{
    protected static ?string $model = Kurban::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';
    protected static ?string $navigationLabel = 'Kurban Yönetimi';
    protected static ?string $navigationGroup = 'Bağış Yönetimi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Bağışçı Adı')
                    ->required(),

                TextInput::make('phone')
                    ->label('Telefon Numarası')
                    ->required(),

                TextInput::make('type')
                    ->label('Kurban Türü')
                    ->placeholder('Nafile, Akika, Adak vb.')
                    ->required(),

                TextInput::make('price')
                    ->label('Fiyat')
                    ->numeric()
                    ->required(),

                Select::make('status')
                    ->label('Durum')
                    ->options([
                        'Pending' => 'Beklemede',
                        'Completed' => 'Tamamlandı',
                        'Cancelled' => 'İptal Edildi',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Bağışçı Adı')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Telefon Numarası')
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Kurban Türü')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Fiyat')
                    ->money('TRY')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Durum')
                    ->enum([
                        'Pending' => 'Beklemede',
                        'Completed' => 'Tamamlandı',
                        'Cancelled' => 'İptal Edildi',
                    ])
                    ->colors([
                        'primary' => 'Pending',
                        'success' => 'Completed',
                        'danger' => 'Cancelled',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        'Pending' => 'Beklemede',
                        'Completed' => 'Tamamlandı',
                        'Cancelled' => 'İptal Edildi',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKurbans::route('/'),
            'create' => Pages\CreateKurban::route('/create'),
            'edit' => Pages\EditKurban::route('/{record}/edit'),
        ];
    }
}
