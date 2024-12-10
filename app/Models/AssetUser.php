<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetUser extends Model
{
    protected $fillable = [
        'asset_id',
        'personnel_no',
        'email',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'department_id',
        'cost_center',
        'project_id',
        'wbs',
        'deployment_date',
        'return_date'
    ];


    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'name');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
