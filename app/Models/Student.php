<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Mass assignment koruması için doldurulabilir alanlar
    protected $fillable = [
        'name',
        'phone',
        'birth_date',
        'birth_country',
        'citizenships',
        'visa_status',
        'school_status',
        'military_status',
        'parent_status',
        'guardian_name',
        'guardian_phone',
        'hometown',
        'languages',
        'photo_path',
        'course_address',
        'latitude',
        'longitude',
    ];
        // Timestamps kullanımı
    public $timestamps = true;

    protected $casts = [
        'citizenships' => 'array',
        'languages' => 'array',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
