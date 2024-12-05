<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Licenses;


class LicenseUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'licenses_id',
        'personnel_no',
        'email',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'department_id',
        'cost_center_id',
        'cost_center',
        'seat_used',
    ];

    public function licenses()
    {
        return $this->belongsTo(Licenses::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'personnel_no');
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
