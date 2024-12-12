<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers\KurbanRelationManager;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'feathericon-user';
    protected static ?string $navigationLabel = 'Bağışçılar';

    protected static ?string $navigationGroup = 'Kişiler';

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

                TextInput::make('email')
                    ->label('E-Posta')
                    ->email()
                    ->nullable(),

                TextInput::make('address')
                    ->label('Adres')
                    ->nullable(),

                Select::make('message_language')
                    ->label('Mesaj Dili')
                    ->options([
                        'TR' => 'Türkçe',
                        'EN' => 'İngilizce',
                    ])
                    ->default('TR')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Bağışçı Adı')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Telefon Numarası'),

                TextColumn::make('message_language')
                    ->label('Mesaj Dili')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'TR' => 'Türkçe',
                        'EN' => 'İngilizce',
                        default => $state,
                    }),

                TextColumn::make('email')
                    ->label('E-Posta'),
            ])
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

    public static function getRelations(): array
    {
        return [
            'kurbans' => KurbanRelationManager::class, // Contact modelindeki ilişki adı
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
