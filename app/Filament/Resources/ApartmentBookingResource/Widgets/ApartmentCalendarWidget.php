<?php

namespace App\Filament\Resources\ApartmentBookingResource\Widgets;

use App\Models\ApartmentBooking;
use Filament\Widgets\Widget;
use Guava\Calendar\Widgets\CalendarWidget;

class ApartmentCalendarWidget extends CalendarWidget
{
    protected string $calendarView = 'dayGridMonth'; // Ay görünümü

    public function getEvents(array $fetchInfo = []): array
    {
        return ApartmentBooking::all()->map(function ($booking) {
            return [
                'title' => $booking->apartment_name . ' Doluluk',
                'start' => $booking->start_date,
                'end'   => $booking->end_date,
            ];
        })->toArray();
    }
}
