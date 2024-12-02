<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Kurban extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'animal_type',
        'sacrifice_date',
        'amount',
        'status',
        'Notes',
        'payment_type',
        'association', // Dernek alanı eklendi
        'phone_num',
        'video_upload_token', 'tracking_code',
        'executor_phone_number', // Kurbanı kesecek kişinin telefon numarası
    ];



    protected static function booted()
    {
        static::creating(function ($kurban) {
            // Eğer video_upload_token boşsa, otomatik olarak bir token oluşturuyoruz
            if (empty($kurban->video_upload_token)) {
                $kurban->video_upload_token = Str::random(32);
            }
        });
    }

    // amount alanını otomatik olarak 50'ye ayarlamak için model olayını kullanıyoruz

}
