<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReportsRelationManager extends RelationManager
{
    protected static string $relationship = 'reports';

    protected static ?string $recordTitleAttribute = 'type';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->label('Rapor Başlığı'),
                Textarea::make('content')->required()->label('Rapor İçeriği'),
                DatePicker::make('report_date')->required()->label('Rapor Tarihi'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Başlık')->searchable(),
                TextColumn::make('content')->label('İçerik')->limit(50),
                TextColumn::make('report_date')->date()->label('Tarih'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(), // Yeni rapor oluşturma
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Rapor düzenleme
                Tables\Actions\DeleteAction::make(), // Rapor silme
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
