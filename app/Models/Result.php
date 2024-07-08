<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable =[
        'student_id',
        'roll_no',
        'stdclass',
        'phone_no',
        'obt_marks',
        'total_marks',
        'term',
        'remarks'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
