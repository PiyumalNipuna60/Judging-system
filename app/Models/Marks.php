<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;

    protected $primaryKey = 'mark_id';

    protected $fillable = [
        'mark',
        'total',
        'averages',
        'teacher_id',
        'student_id',
    ];

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsTo(Teacher::class, 'student_id');
    }
}
