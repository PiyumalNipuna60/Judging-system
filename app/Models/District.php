<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $primaryKey = 'district_id';

    protected $fillable = [
        'district_id',
        'name',
    ];

    public function districtDetail()
    {
        return $this->hasMany(District_detail::class, 'district_detail_id');
    }
}
