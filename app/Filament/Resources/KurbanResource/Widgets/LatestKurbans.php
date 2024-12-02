<?php

namespace App\Filament\Resources\KurbanResource\Widgets;

use App\Models\Kurban;
use Closure;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestKurbans extends BaseWidget
{

    protected static ?string $heading = 'Kurban İstatistikleri';
    protected int | string | array $columnSpan = 'full'; // Widget'ı tam genişlikte yapar

    protected function getTableQuery(): Builder
    {
        return Kurban::query()->latest()->limit(5); // Son 5 kaydı getir
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('donor_name')
                ->label('İsim Soyisim'),
            Tables\Columns\TextColumn::make('amount'),
        ];
    }
}
