<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;
    protected static ?string $navigationGroup = 'Talabe İşleri';

    protected static ?string $navigationLabel = 'Talabe Raporları';

    protected static ?string $navigationIcon = 'carbon-report';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->relationship('student', 'name') // Öğrenci seçimi
                ->required()
                ->label('Öğrenci'),
            TextInput::make('title')
                ->required()
                ->label('Rapor Başlığı'),
            Textarea::make('content')
                ->required()
                ->label('Rapor İçeriği'),
            DatePicker::make('report_date')
                ->required()
                ->label('Rapor Tarihi'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')->label('Öğrenci'),
                TextColumn::make('title')->label('Başlık')->searchable(),
                TextColumn::make('report_date')->date()->label('Tarih'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
