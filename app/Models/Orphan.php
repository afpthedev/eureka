<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        // 'amount' alanını burada belirlemiyoruz çünkü otomatik olarak 50 olarak atanacak
    ];

    // amount alanını otomatik olarak 50'ye ayarlamak için model olayını kullanıyoruz
    protected static function booted()
    {
        static::creating(function ($orphan) {
            $orphan->amount = 50;
        });
    }
}
