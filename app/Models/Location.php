<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'parent_location',
        'location_address',
        'municipality_id',
        'province_id',
        'region_id',
        'location_country',
        'location_zip'
    ];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    public function provinces()
    {
        return $this->belongsTo(Province::class);
    }
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

}
