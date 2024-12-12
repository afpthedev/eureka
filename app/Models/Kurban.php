<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurban extends Model
{
    use HasFactory;

    protected $fillable = ['contact_id', 'type', 'sacrifice_date',
        'price',
        'status',
        'payment_type',
        'association',
        'Notes'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
