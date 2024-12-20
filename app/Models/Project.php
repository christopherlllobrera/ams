<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'wbs',
        'project_name',
        'project_description'
    ];

    public function user()
    {
        return $this->belongsTo(Asset::class);
    }

    public function AssetUser()
    {
        return $this->belongsTo(AssetUser::class);
    }
}
