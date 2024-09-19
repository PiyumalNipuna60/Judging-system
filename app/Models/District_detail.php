<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District_detail extends Model
{
    use HasFactory;

    protected $primaryKey = 'district_detail_id';

    protected $fillable = [
        'district_detail_id',
        'teacher_id',
        'district_id'
    ];

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function Districts()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
