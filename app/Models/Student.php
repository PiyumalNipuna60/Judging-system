<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_id',
        'setial_no',
        'medium',
        'age',
        'image',
        'student_detail',
        'stream',
    ];

    public function Marks()
    {
        return $this->hasMany(Marks::class, 'student_id');
    }
}
