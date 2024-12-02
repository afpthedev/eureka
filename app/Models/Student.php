<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Student extends Model
{
    use HasFactory;


    /**
     * Toplu atama yapılabilecek alanlar
     */
    protected $fillable = [
        'profile_picture',
        'first_name',
        'last_name',
        'email',
        'student_number',
        'mother_name',
        'father_name',
        'city',
        'district',
        'school_name',
    ];



    public function setProfilePictureAttribute($value)
    {
        if ($value instanceof TemporaryUploadedFile) {
            $this->attributes['profile_picture'] = base64_encode(file_get_contents($value->getRealPath()));
        } else {
            $this->attributes['profile_picture'] = $value;
        }
    }

}
