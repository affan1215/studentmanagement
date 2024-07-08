<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'roll_no',
        'stdclass',
        'phone_no',
    ];
    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
