<?php

namespace App\Models;

use Guava\Calendar\ValueObjects\Event;
use Illuminate\Database\Eloquent\Model;

class ApartmentBooking extends Model
{
    protected $fillable = ['apartment_name', 'start_date', 'end_date', 'description'];

    // Takvim için gerekli Event formatı
    public function toEvent(): Event|array
    {
        return Event::make($this)
            ->title($this->apartment_name . ' Doluluk')
            ->start($this->start_date)
            ->end($this->end_date)
            ->backgroundColor('#ffcc00') // Örnek renk
        ->textColor('#ffffff'); // Örnek büyüklük
    }
}
