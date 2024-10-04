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
        'asset_models_id',
        'serial_number',
        'status_id',
        'companies_id',
        'departments_id',
        'project_id',
        'cost_center',
        'locations_id',
        'asset_note',
        'assigned_to',
        'assigned_date',
        'return_date',
    ];

    public function company()
    {
        return $this->hasMany(Company::class);
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
