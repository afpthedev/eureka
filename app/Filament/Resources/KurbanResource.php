<?php
namespace App\Filament\Resources;

use App\Filament\Resources\KurbanResource\Pages\CreateKurban;
use App\Filament\Resources\KurbanResource\Pages\ListKurbans;
use App\Models\Contact;
use App\Models\Kurban;
use database\EditKurban;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\Filter;



class KurbanResource extends Resource
{
    protected static ?string $navigationGroup = 'Bağışlar';
    protected static ?string $model = Kurban::class;
    protected static ?string $navigationIcon = 'mdi-sheep';
    protected static ?string $navigationLabel = 'Kurban Bağışları';


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
                Select::make('association')
                    ->label('Dernek')
                    ->options([
                        'MANA' => 'MANA',
                        'SAHA' => 'SAHA',
                        'HİCAZ' => 'HİCAZ',
                        'HEDEF' => 'HEDEF',
                    ])->default('MANA')
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
                    ->required()
                    ->default(120),
                Textarea::make('Notes')
                    ->label('Notlar')
                    ->nullable(), // İsteğe bağlı

                Select::make('payment_type')
                    ->label('Ödeme Türü')
                    ->options([
                        'Paypal' => 'Paypal',
                        'Nakit' => 'Nakit',
                        'Banka' => 'Banka',
                    ])->default('Banka')
                    ->required(),
                DatePicker::make('sacrifice_date')
                    ->label('Kurban Kesim Tarihi')
                    ->required()
                    ->default(now()),
                Select::make('status')
                    ->label('Durum')
                    ->options([
                        'Ödendi' => 'Ödendi',
                        'Ödenmedi' => 'Ödenmedi',
                    ])
                    ->default('Ödenmedi') // Varsayılan değer Ödenmedi
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
                TextColumn::make('sacrifice_date')
                    ->label('Kurban Kesim Tarihi')
                    ->sortable(),
            ])->filters([
                // Dernek Filtreleme
                Tables\Filters\SelectFilter::make('association')
                    ->label('Dernek')
                    ->options([
                        'MANA' => 'MANA',
                        'SAHA' => 'SAHA',
                        'HİCAZ' => 'HİCAZ',
                        'HEDEF' => 'HEDEF',
                    ]),
                    // Kurban Türü Filtreleme
                SelectFilter::make('type')
                        ->label('Kurban Türü')
                        ->options([
                            'Nafile' => 'Nafile',
                            'Akika' => 'Akika',
                            'Adak' => 'Adak',
                        ]),

                    // Durum Filtreleme
                SelectFilter::make('status')
                        ->label('Durum')
                        ->options([
                            'Ödendi' => 'Ödendi',
                            'Ödenmedi' => 'Ödenmedi',
                        ]),

                    // Ödeme Türü Filtreleme
                    SelectFilter::make('payment_type')
                        ->label('Ödeme Türü')
                        ->options([
                            'Banka' => 'Banka',
                            'Nakit' => 'Nakit',
                            'Paypal' => 'Paypal',
                        ]),

                    // Fiyat Aralığı Filtreleme
                    Filter::make('price_range')
                        ->label('Fiyat Aralığı')
                        ->form([
                            TextInput::make('min_price')
                                ->label('Min Fiyat')
                                ->numeric(),
                            TextInput::make('max_price')
                                ->label('Max Fiyat')
                                ->numeric(),
                        ])
                        ->query(function ($query, $data) {
                            return $query
                                ->when($data['min_price'], fn ($q) => $q->where('price', '>=', $data['min_price']))
                                ->when($data['max_price'], fn ($q) => $q->where('price', '<=', $data['max_price']));
                        }),


                ])
                ->filtersFormColumns(2)
                ->filtersFormSchema(fn (array $filters): array => [
                    Section::make('Kurban Filtreleri')
                        ->description('Kayıtları filtrelemek için aşağıdaki seçenekleri kullanabilirsiniz.')
                        ->schema([
                            $filters['type'],
                            $filters['status'],
                            $filters['payment_type'],
                            $filters['price_range'],
                            $filters['association'],
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
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

                // Tüm liste için Excel indir
                Tables\Actions\BulkAction::make('export_all_excel')
                    ->label('Excel Olarak İndir')
                    ->icon('fileicon-microsoft-excel')
                    ->action(function () {
                        $kurbans = Kurban::with('contact')->get(); // Tüm listeyi alıyoruz

                        return \Maatwebsite\Excel\Facades\Excel::download(
                            new \App\Exports\KurbanExport($kurbans),
                            'kurbans_all.xlsx'
                        );
                    }),

                // Tüm liste için PDF indir
                Tables\Actions\BulkAction::make('export_all_pdf')
                    ->label('PDF Olarak İndir')
                    ->icon('carbon-generate-pdf')
                    ->action(function () {
                        $kurbans = Kurban::with('contact')->get(); // Tüm listeyi alıyoruz

                        $data = $kurbans->map(function ($kurban) {
                            return [
                                'Bağışçı Adı' => $kurban->contact->name ?? '',
                                'Telefon Numarası' => $kurban->contact->phone ?? '',
                                'Kurban Türü' => $kurban->type,
                                'Fiyat' => $kurban->price,
                                'Kurban Kesim Tarihi' => $kurban->sacrifice_date,
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
            'edit' => \App\Filament\Resources\KurbanResource\Pages\EditKurban::route('/{record}/edit'),
        ];
    }
}
