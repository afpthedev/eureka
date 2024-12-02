<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HafizResource\Pages;
use App\Models\Hafiz;
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

class HafizResource extends Resource
{
    protected static ?string $model = Hafiz::class;
    protected static ?string $navigationGroup = 'Projeler';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Hafız';
    protected static ?string $pluralLabel = 'Hafızlar';
    protected static ?string $label = 'Hafız';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Adı')
                    ->required(),
                DatePicker::make('graduation_date')
                    ->label('Mezuniyet Tarihi')
                    ->nullable(),
                TextInput::make('madrasa_name')
                    ->label('Medrese Adı')
                    ->nullable(),
                TextInput::make('city')
                    ->label('Şehir')
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
                TextColumn::make('name')
                    ->label('Adı')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('graduation_date')
                    ->label('Mezuniyet Tarihi')
                    ->date()
                    ->sortable(),
                TextColumn::make('madrasa_name')
                    ->label('Medrese Adı')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')
                    ->label('Şehir')
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
            'index' => Pages\ListHafizs::route('/'),
            'create' => Pages\CreateHafiz::route('/create'),
            'edit' => Pages\EditHafiz::route('/{record}/edit'),
        ];
    }
}
