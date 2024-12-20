<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_name',
        'URL',
        'manufacturer_email',
        'manufacturer_phone',
        'manufacturer_attachment'
    ];

}
