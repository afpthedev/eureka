<?php

namespace App\Filament\Resources;

use Filament\Tables\Actions\ActionGroup;
use App\Filament\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DonationResource extends Resource
{
    protected static ?string $navigationGroup = 'Bağışlar';


    protected static ?string $model = Donation::class;


    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Bağış Kayıtları';
    protected static ?string $pluralLabel = 'Bağış Kayıtları';
    protected static ?string $label = 'Bağış Kaydı';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('İsim')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('E-posta')
                    ->email()
                    ->nullable(),
                Forms\Components\TextInput::make('phone_number')
                    ->label('Telefon Numarası')
                    ->tel()
                    ->nullable(),
                Forms\Components\TextInput::make('address')
                    ->label('Adres')
                    ->nullable(),
                Forms\Components\DatePicker::make('donation_date')
                    ->label('Bağış Tarihi')
                    ->nullable()
                ->default(now()),
                Forms\Components\TextInput::make('amount')
                    ->label('Bağış Miktarı')
                    ->numeric()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('İsim')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->label('E-posta')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone_number')->label('Telefon Numarası'),
                Tables\Columns\TextColumn::make('donation_date')->label('Bağış Tarihi')->date(),
                Tables\Columns\TextColumn::make('amount')->label('Bağış Miktarı')->money('TRY'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Ödendi' => 'Ödendi',
                        'Ödenmedi' => 'Ödenmedi',
                    ])], layout: FiltersLayout::Modal)
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }
}
