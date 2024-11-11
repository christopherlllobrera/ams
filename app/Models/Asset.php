<?php

namespace App\Models;

use App\Models\AssetLifeCycle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [

        'company_id',
        'company_number',
        'asset_code',
        'asset_type',
        'asset_categories',
        'asset_model_id',
        'serial_number',
        'asset_status',
        'location_id',
        'department_id',
        'project_id',
        'asset_note',

        'depreciation_cost',
        'depreciation_year',
        'EOL_date',
        'supplier_name',
        'purchase_receipt',
        'purchase_date',
        'purchase_order',
        'purchase_cost',
        'delivery_receipt',
        'good_receipt',

        //specification
        'operating_system',
        'processor',
        'RAM',
        'storage',
        'GPU',
        'color',
        'MAC_address',

        //user
        'full_name',
        'personnel number',
        'job_title',
        'location',
        'department',
        'project_name',
        'cost_center',
        'deployment_date',
        'return_date'

    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function AssetModel(){
        return $this->belongsTo(AssetModel::class);
    }
    public function AssetLifeCycle()
    {
        return $this->belongsTo(AssetLifeCycle::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
