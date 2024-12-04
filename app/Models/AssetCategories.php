<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_type',
        'categories',
    ];
}
