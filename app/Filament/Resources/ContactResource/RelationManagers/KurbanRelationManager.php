<?php

namespace App\Filament\Resources\ContactResource\RelationManagers;

use App\Models\Kurban;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Forms;

class KurbanRelationManager extends RelationManager
{
    protected static string $relationship = 'kurbans'; // Contact modelindeki ilişki adı
    protected static ?string $recordTitleAttribute = 'type';

    public static function table(Tables\Table $table): Tables\Table
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
            ])
            ->filters([]) // Ekstra filtreler eklemek isterseniz burada tanımlayabilirsiniz
            ->headerActions([
                Tables\Actions\CreateAction::make(), // Yeni kurban bağışı ekleme
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function form(Forms\Form $form): Forms\Form
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
                    ->required(),

                Forms\Components\Textarea::make('note')
                    ->label('Niyet Notu')
                    ->nullable(),
            ]);
    }
}
