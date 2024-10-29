<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_model_name',
        'asset_model_number',
        'manufacturer_id',
        'model_notes'
    ];

    public function Manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
