<?php
namespace App\Filament\Resources;

use App\Exports\KurbanExport;
use App\Filament\Resources\KurbanResource\Pages\CreateKurban;
use App\Filament\Resources\KurbanResource\Pages\EditKurban;
use App\Filament\Resources\KurbanResource\Pages\ListKurbans;
use App\Models\Contact;
use App\Models\Kurban;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

class KurbanResource extends Resource
{
    protected static ?string $model = Kurban::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Use a select for existing contacts or create new
                Select::make('contact_id')
                    ->label('Bağışçı')
                    ->options(Contact::all()->pluck('name', 'id'))
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('Ad Soyad'),
                        TextInput::make('phone')
                            ->required()
                            ->label('Telefon Numarası'),
                        Select::make('message_language')
                            ->label('Mesaj Dili')
                            ->options([
                                'tr' => 'Türkçe',
                                'en' => 'İngilizce'
                            ])
                    ])
                    ->createOptionUsing(function (array $data): ?int {
                        // Check if a contact with this phone number already exists
                        $existingContact = Contact::where('phone', $data['phone'])->first();

                        if ($existingContact) {
                            return $existingContact->id;
                        }

                        // Create a new contact if it doesn't exist
                        $contact = Contact::create([
                            'name' => $data['name'],
                            'phone' => $data['phone'],
                            'message_language' => $data['message_language'] ?? 'tr', // Default to Turkish
                        ]);

                        return $contact->id;
                    })
                    ->required(),

                // Kurban specific fields
                Select::make('type')
                    ->label('Kurban Türü')
                    ->options([
                        'Nafile' => 'Nafile',
                        'Akika' => 'Akika',
                        'Adak' => 'Adak',
                    ])
                    ->required(),

                TextInput::make('price')
                    ->label('Fiyat')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contact.name')
                    ->label('Bağışçı Adı')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('contact.phone')
                    ->label('Telefon Numarası')
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Kurban Türü'),

                TextColumn::make('price')
                    ->label('Fiyat')
                    ->money('TRY'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

                // Tüm liste için Excel indir
                Tables\Actions\BulkAction::make('export_all_excel')
                    ->label('Tüm Listeyi Excel Olarak İndir')
                    ->icon('fileicon-microsoft-excelcomposer require barryvdh/laravel-dompdf

')
                    ->action(function () {
                        $kurbans = Kurban::with('contact')->get(); // Tüm listeyi alıyoruz

                        return \Maatwebsite\Excel\Facades\Excel::download(
                            new \App\Exports\KurbanExport($kurbans),
                            'kurbans_all.xlsx'
                        );
                    }),

                // Tüm liste için PDF indir
                Tables\Actions\BulkAction::make('export_all_pdf')
                    ->label('Tüm Listeyi PDF Olarak İndir')
                    ->icon('carbon-generate-pdf')
                    ->action(function () {
                        $kurbans = Kurban::with('contact')->get(); // Tüm listeyi alıyoruz

                        $data = $kurbans->map(function ($kurban) {
                            return [
                                'Bağışçı Adı' => $kurban->contact->name ?? '',
                                'Telefon Numarası' => $kurban->contact->phone ?? '',
                                'Kurban Türü' => $kurban->type,
                                'Fiyat' => $kurban->price,
                            ];
                        });

                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.kurbans', compact('data'));
                        return $pdf->download('kurbans_all.pdf');
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKurbans::route('/'),
            'create' => CreateKurban::route('/create'),
            'edit' => EditKurban::route('/{record}/edit'),
        ];
    }
}
