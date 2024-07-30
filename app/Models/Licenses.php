<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'software_name',
        'category_id', // foreign key
        'product_key',
        'seat',
        'company_id',
        'manufacturers_id', // foreign key
        'license_to_name',
        'license_to_email',
        'reassignable',
        'license_order_number',
        'license_purchase_cost',
        'license_purchase_date',
        'license_expiration_date',
        'license_termination_date',
        'license_purchase_order_number',
        'depreciation',
        'maintained',
        'license_notes'
    ];

}
