<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'companies_id',
        'asset_tag',
        'asset_name',
        'asset__models_id',
        'serial_number',
        'status',
        'locations_id',
        'purchase_date',
        'supplier_id',
        'order_number',
        'purchase_cost',
        'warranty',
        'asset_note',
        'requestable',
        'assigned_to',
        'assigned_date',
        'return_date',
        'asset_actions',
        'purchase_order_number',
        'purchase_receipt',
        'delivery_receipt',
        'warranty_terms',
        'operating_system',
        'processor',
        'generation',
        'ram',
        'hdd',
        'ssd',
        'gpu',
        'color',
        'mac_wifi',
        'mac_lan',
        'cost_center',
        'trend_micro',
        'rapid_seven'
    ];
}
