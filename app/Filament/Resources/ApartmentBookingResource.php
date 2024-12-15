<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApartmentBookingResource\Pages;
use App\Filament\Resources\ApartmentBookingResource\Widgets\ApartmentCalendarWidget;
use App\Models\ApartmentBooking;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class ApartmentBookingResource extends Resource
{
    protected static ?string $model = ApartmentBooking::class;

    protected static ?string $navigationIcon = 'lucide-house';
    protected static ?string $navigationGroup = 'Apart Yönetimi';

    protected static ?string $navigationLabel = 'Apart Yönetimi';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('apartment_name')
                ->label('Daire Adı')
                ->required(),

            Forms\Components\DatePicker::make('start_date')
                ->label('Başlangıç Tarihi')
                ->required(),

            Forms\Components\DatePicker::make('end_date')
                ->label('Bitiş Tarihi')
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Açıklama')
                ->nullable(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('apartment_name')
                    ->label('Daire Adı')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Başlangıç Tarihi')
                    ->date(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Bitiş Tarihi')
                    ->date(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Açıklama')
                    ->limit(30),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApartmentBookings::route('/'),
            'create' => Pages\CreateApartmentBooking::route('/create'),
            'edit' => Pages\EditApartmentBooking::route('/{record}/edit'),
        ];
    }
}
