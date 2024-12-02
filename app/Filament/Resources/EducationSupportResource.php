<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationSupportResource\Pages;
use App\Models\EducationSupport;
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

class EducationSupportResource extends Resource
{
    protected static ?string $model = EducationSupport::class;
    protected static ?string $navigationGroup = 'Projeler';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Eğitim Desteği';
    protected static ?string $pluralLabel = 'Eğitim Destekleri';
    protected static ?string $label = 'Eğitim Desteği';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('student_name')
                    ->label('Öğrenci Adı')
                    ->required(),
                TextInput::make('school_name')
                    ->label('Okul Adı')
                    ->required(),
                TextInput::make('class')
                    ->label('Sınıf')
                    ->nullable(),
                TextInput::make('city')
                    ->label('Şehir')
                    ->nullable(),
                Textarea::make('needs')
                    ->label('İhtiyaçlar')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_name')
                    ->label('Öğrenci Adı')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('school_name')
                    ->label('Okul Adı')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('class')
                    ->label('Sınıf')
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

    protected function getActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV Import')
                ->modalHeading('Import Donations from CSV')
                ->importer(DonationImporter::class),
            Actions\CreateAction::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducationSupports::route('/'),
            'create' => Pages\CreateEducationSupport::route('/create'),
            'edit' => Pages\EditEducationSupport::route('/{record}/edit'),
        ];
    }
}
