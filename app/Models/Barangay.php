<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'municipalities_id',
        'barangay_id',
        'barangay_name',
    ];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
