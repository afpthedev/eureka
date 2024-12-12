<?php

namespace App\Filament\Resources\ContactResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;

class KurbanRelationManager extends RelationManager
{
    protected static string $relationship = 'kurbans'; // Contact modelindeki ilişki adı
    protected static ?string $recordTitleAttribute = 'type';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Kurban Türü')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Fiyat')
                    ->money('TRY'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Bağış Tarihi')
                    ->date(),

                Tables\Columns\TextColumn::make('note')
                    ->label('Niyet Notu')
                    ->default('Belirtilmedi'),

                Tables\Columns\TextColumn::make('association')
                    ->label('Dernek'),

                Tables\Columns\TextColumn::make('payment_type')
                    ->label('Ödeme Türü'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Durum'),
            ])
            ->filters([]) // Filtre eklemek isterseniz buraya tanımlayabilirsiniz
            ->headerActions([
                Tables\Actions\CreateAction::make(), // Yeni kurban bağışı ekleme
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Kurban Türü')
                    ->options([
                        'Nafile' => 'Nafile',
                        'Akika' => 'Akika',
                        'Adak' => 'Adak',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Fiyat')
                    ->numeric()
                    ->required()
                    ->default(120),

                Forms\Components\Textarea::make('note')
                    ->label('Niyet Notu')
                    ->nullable(),

                Forms\Components\Select::make('payment_type')
                    ->label('Ödeme Türü')
                    ->options([
                        'Paypal' => 'Paypal',
                        'Nakit' => 'Nakit',
                        'Banka' => 'Banka',
                    ])
                    ->default('Banka')
                    ->required(),

                Forms\Components\DatePicker::make('sacrifice_date')
                    ->label('Kurban Kesim Tarihi')
                    ->required()
                    ->default(now()),

                Forms\Components\Select::make('status')
                    ->label('Durum')
                    ->options([
                        'Ödendi' => 'Ödendi',
                        'Ödenmedi' => 'Ödenmedi',
                    ])
                    ->default('Ödenmedi')
                    ->required(),

                Forms\Components\Select::make('association')
                    ->label('Dernek')
                    ->options([
                        'MANA' => 'MANA',
                        'SAHA' => 'SAHA',
                        'HİCAZ' => 'HİCAZ',
                        'HEDEF' => 'HEDEF',
                    ])
                    ->default('MANA')
                    ->required(),
            ]);
    }
}
