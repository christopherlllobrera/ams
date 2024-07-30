<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset_Model extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_model_name',
        'asset_model_number',
        'manufacturers_id',
        'categories_id',
        'depreciation',
        'model_notes'
    ];

}

