<?php

namespace App\Models;

use App\Models\AssetLifeCycle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [

        'asset_tag',
        'asset_name',
        'asset_model_id',
        'serial_number',
        'asset_life_cycle_id',
        'company_id',
        'department_id',
        'project_id',
        'cost_center',
        'location_id',
        'asset_note',
        'assigned_to',
        'assigned_date',
        'return_date',
        'categories_id',
        'asset_attachment'
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
