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
        'assetlifecycle_id',
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
        'good_receipt',
        'delivery_date',
        'delivery_receipt',
        'end_of_warranty',
        'start_of_warranty',
        'purchase_attachment',

        //specification
        'operating_system',
        'processor',
        'RAM',
        'storage',
        'GPU',
        'color',
        'MAC_address',
        'image',

    ];

    protected $casts = [
        'asset_attachment' => 'array',
        'image' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function AssetModel(){
        return $this->belongsTo(AssetModel::class);
    }
    public function assetlifecycle()
    {
        return $this->belongsTo(AssetLifeCycle::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    //relationsip
    public function user()
    {
        return $this->belongsTo(User::class, 'personnel_no');
    }
    public function assetuser()
    {
        return $this->hasMany(AssetUser::class , 'asset_id');
    }
}
