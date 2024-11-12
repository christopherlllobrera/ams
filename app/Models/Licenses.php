<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'software_name',
        'categories_id', 
        'product_key',
        'seat',
        'supplier_id',
        'manufacturers_id',
        'registered_name',
        'registered_email',
        'license_order_number',
        'license_purchase_cost',
        'license_purchase_date',
        'license_expiration_date',
        'license_notes',
        'license_attachment'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
