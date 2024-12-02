<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kumanya extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'quantity',
        'distribution_date',
        'recipient',
        'notes',
        // 'amount' alanını burada belirlemiyoruz çünkü otomatik olarak 50 olarak atanacak
    ];

    // amount alanını otomatik olarak 50'ye ayarlamak için model olayını kullanıyoruz
    protected static function booted()
    {
        static::creating(function ($kumanya) {
            $kumanya->amount = 50;
        });
    }
}
