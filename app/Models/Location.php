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
        'location_city',
        'location_region',
        'location_country',
        'location_zip'
    ];

}
