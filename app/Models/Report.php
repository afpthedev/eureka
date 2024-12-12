<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model

{
    protected $fillable = [
        'student_id',
        'title',
        'content',
        'report_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'report_date' => 'date',
    ];

    /**
     * Get the student that owns the report.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
