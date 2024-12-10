<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Licenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'software_name',
        'categories_id',
        'product_key',
        'serial_key',
        'seat',
        'seat_count',
        'supplier_id',
        'manufacturer_id',
        'registered_name',
        'registered_email',
        'license_order_number',
        'license_purchase_cost',
        'license_purchase_date',
        'license_expiration_date',
        'license_notes',
        'license_attachment'
    ];

    protected $casts = [
        'license_attachment' => 'array',
        'license_expiration_date' => 'datetime',
    ];

    public function totalSeat(): int
    {
        return $this->licenseusers()->sum('seat_used');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function licenseusers()
    {
        return $this->hasMany(LicenseUser::class);
    }

}
