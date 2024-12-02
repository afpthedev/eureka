<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HijabScarfSupportResource\Pages;
use App\Models\HijabScarfSupport;
use App\Models\HijabSupport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class HijabScarfSupportResource extends Resource
{
    protected static ?string $model = HijabSupport::class;
    protected static ?string $navigationGroup = 'Projeler';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Tesettür-Eşarp Desteği';
    protected static ?string $pluralLabel = 'Tesettür-Eşarp Destekleri';
    protected static ?string $label = 'Tesettür-Eşarp Desteği';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('recipient_name')
                    ->label('Alıcı Adı')
                    ->required(),
                TextInput::make('city')
                    ->label('Şehir')
                    ->nullable(),
                TextInput::make('contact_number')
                    ->label('İletişim Numarası')
                    ->tel()
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
                TextColumn::make('recipient_name')
                    ->label('Alıcı Adı')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')
                    ->label('Şehir')
                    ->sortable(),
                TextColumn::make('contact_number')
                    ->label('İletişim Numarası'),
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
            'index' => Pages\ListHijabScarfSupports::route('/'),
            'create' => Pages\CreateHijabScarfSupport::route('/create'),
            'edit' => Pages\EditHijabScarfSupport::route('/{record}/edit'),
        ];
    }
}
