<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'supplier_address',
        'municipality_id',
        'province_id',
        'supplier_country',
        'supplier_zip',
        'supplier_contact_name',
        'supplier_contact_phone',
        'supplier_fax',
        'supplier_email',
        'supplier_website',
        'supplier_notes',
        'supplier_attachment'
    ];

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
    public function municipality()//city
    {
        return $this->belongsTo(Municipality::class);
    }
}
