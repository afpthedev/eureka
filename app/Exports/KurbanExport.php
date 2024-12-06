<?php

namespace App\Exports;

use App\Models\Kurban;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KurbanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Export için verileri al
        return Kurban::with('contact')->get()->map(function ($kurban) {
            return [
                'Bağışçı Adı' => $kurban->contact->name ?? '',
                'Telefon Numarası' => $kurban->contact->phone ?? '',
                'Kurban Türü' => $kurban->type,
                'Fiyat' => $kurban->price,
            ];
        });
    }

    public function headings(): array
    {
        // Excel başlıkları
        return ['Bağışçı Adı', 'Telefon Numarası', 'Kurban Türü', 'Fiyat'];
    }
}
