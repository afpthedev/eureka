<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['contact_id', 'entry_time', 'exit_time', 'purpose', 'notes'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
