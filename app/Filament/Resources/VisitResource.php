<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use App\Models\Contact;
use App\Models\Visit;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Ziyaretçi Bilgileri';

    protected static  ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Ziyaretçi Yönetimi';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('contact_id')
                    ->label('Ziyaretçi')
                    ->options(Contact::all()->pluck('name', 'id'))
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->required()->label('Ad Soyad'),
                        Forms\Components\TextInput::make('phone')->required()->label('Telefon Numarası'),
                    ])
                    ->createOptionUsing(function (array $data): ?int {
                        // Kayıtlı kişi kontrolü
                        $existingContact = Contact::where('phone', $data['phone'])->first();

                        if ($existingContact) {
                            return $existingContact->id;
                        }

                        // Yeni bir kişi oluştur
                        return Contact::create($data)->id;
                    })
                    ->required(),

                DatePicker::make('entry_time')
                    ->label('Giriş Zamanı')
                    ->default(now())
                    ->required(),

                DatePicker::make('exit_time')
                    ->label('Çıkış Zamanı'),

                Forms\Components\TextInput::make('purpose')
                    ->label('Ziyaret Nedeni')
                    ->required(),

                Textarea::make('notes')
                    ->label('Notlar')
                    ->rows(3),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('contact.name')
                    ->label('Ziyaretçi Adı')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('contact.phone')
                    ->label('Telefon Numarası'),

                TextColumn::make('entry_time')
                    ->label('Giriş Zamanı')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('exit_time')
                    ->label('Çıkış Zamanı')
                    ->dateTime(),

                TextColumn::make('purpose')
                    ->label('Ziyaret Nedeni'),
            ])
            ->filters([
                Tables\Filters\Filter::make('today')
                    ->label('Bugünkü Ziyaretler')
                    ->query(fn ($query) => $query->whereDate('entry_time', today())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
        ];
    }
}
