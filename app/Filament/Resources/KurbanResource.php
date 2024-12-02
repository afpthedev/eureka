<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KurbanResource\Pages;
use App\Models\Kurban;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class KurbanResource extends Resource
{
    protected static ?string $navigationGroup = 'Bağışlar';


    protected static ?string $model = Kurban::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationLabel = 'Kurban Bağışları';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('donor_name')
                    ->label('Bağışçı Adı')
                    ->required(),
                TextInput::make('phone_num')
                    ->label('Bağışçı Telefon Numarası')
                    ->required(),
                Select::make('association')
                    ->label('Dernek')
                    ->options([
                        'MANA' => 'MANA',
                        'SAHA' => 'SAHA',
                        'HİCAZ' => 'HİCAZ',
                        'HEDEF' => 'HEDEF',
                    ])->default('MANA')
                    ->required(),
                Select::make('animal_type')
                    ->label('Kurban Türü')
                    ->options([
                        'Adak' => 'Adak',
                        'Şifa' => 'Şifa',
                        'Sadakalı Şifa' => 'Sadakalı Şifa',
                        'Akika' => 'Akika',
                    ])->default('Adak')
                    ->required(),
                DatePicker::make('sacrifice_date')
                    ->label('Kurban Kayıt Tarihi')
                    ->required()
                ->default(now()),
                TextInput::make('amount')
                    ->label('Bağış Miktarı')
                    ->default(50),
                Select::make('status')
                    ->label('Durum')
                    ->options([
                        'Ödendi' => 'Ödendi',
                        'Ödenmedi' => 'Ödenmedi',
                    ])
                    ->default('Ödenmedi') // Varsayılan değer Ödenmedi
                    ->required(),
                Textarea::make('Notes')
                    ->label('Notlar')
                    ->nullable(), // İsteğe bağlı
                Select::make('payment_type')
                    ->label('Ödeme Türü')
                    ->options([
                        'Paypal' => 'Paypal',
                        'Nakit' => 'Nakit',
                        'Banka' => 'Banka',
                    ])->default('Banka')
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donor_name')
                    ->label('Bağışçı Adı')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('animal_type')
                    ->label('Kurban Türü')
                    ->sortable(),
                TextColumn::make('sacrifice_date')
                    ->label('Kurban Kesim Tarihi')
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Bağış Miktarı')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Durum')
                    ->sortable(),
                TextColumn::make('payment_type')
                    ->label('Ödeme Türü')->sortable(),
                TextColumn::make('association')
                    ->label('Dernek')
                    ->sortable(),
                TextColumn::make('Notes')
                    ->label('Notlar')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        'Ödendi' => 'Ödendi',
                        'Ödenmedi' => 'Ödenmedi',
                    ]),
            ], layout: FiltersLayout::Modal)
            ->actions([


                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),

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
