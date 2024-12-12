<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('photo_path')->image()->label('Fotoğraf'),
            TextInput::make('name')->required()->label('Talebenin Adı'),
            TextInput::make('phone')->tel()->label('Telefon Numarası'),
            DatePicker::make('birth_date')->label('Doğum Tarihi'),
            TextInput::make('birth_country')->label('Doğduğu Ülke'),
            Select::make('citizenships')
                ->multiple()
                ->options([
                    'Türkiye' => 'Türkiye',
                    'ABD' => 'ABD',
                    'Almanya' => 'Almanya',
                    'Avusturya'=> 'Avusturya',
                    'İtalya'=> 'İtalya',
                    'Slovakya'=> 'Slovakya',
                    'Malta'=> 'Malta',
                    'İsviçre'=> 'İsviçre',
                    'Slovenya'=> 'Slovenya',
                    'Hırvatıstan'=> 'Hırvatıstan',
                    'Macaristan'=> 'Macaristan',
                ])->label('Vatandaşlıkları'),
            Select::make('school_status')
                ->options([
                    'student' => 'Öğrenci',
                    'graduate' => 'Mezun',
                    'dropped_out' => 'Okulu Bırakmış',
                ])->label('Okul Durumu'),
            Select::make('military_status')
                ->options([
                    'completed' => 'Tamamlanmış',
                    'postponed' => 'Ertelenmiş',
                    'not_applicable' => 'Geçerli Değil',
                ])->label('Askerlik Durumu'),
            Select::make('parent_status')
                ->options([
                    'Anne Baba Birlikte' => 'Anne Baba Birlikte',
                    'Ayrı' => 'Ayrı',
                    'Anne Vefat' => 'Anne Vefat',
                    'Baba Vefat' => 'Baba Vefat',
                ])->label('Anne Baba Durumu'),
            TextInput::make('guardian_name')->label('İrtibat Veli Adı'),
            TextInput::make('guardian_phone')->tel()->label('İrtibat Veli Telefon'),
            TextInput::make('hometown')->label('Memleketi'),
            TagsInput::make('languages')->label('Bildiği Diller'),
            Select::make('languages')
                ->options([
                    'Türkçe' => 'Türkçe',
                    'Almanca' => 'Almanca',
                    'İngilizce' => 'İngilizce',
                    'Fransızca'=> 'Fransızca',
                    'İtalyanca'=> 'İtalyanca',
                    'Hırvatça'=> 'Hırvatça',
                    'Macarca'=> 'Macarca',
                    'Slovakca'=> 'Slovakca',
                ])->label('Bildiği Diller'),
            TextInput::make('course_address')->label('Kurs Adresi')->hint('Google Maps için adres giriniz.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path'),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('birth_date')->date(),
                TextColumn::make('birth_country'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
