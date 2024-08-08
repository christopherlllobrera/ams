<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [

        'province_id',
        'municipality_id',
        'municipality_name',
    ];

    public function barangay()
    {
        return $this->hasMany(Barangay::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
