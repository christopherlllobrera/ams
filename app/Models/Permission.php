<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Permission\Models\Permission as ModelsPermission;


class Permission extends ModelsPermission
{
    use HasFactory;
}
