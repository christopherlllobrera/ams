<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function view(User $user, Department $department)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function update(User $user, Department $department)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function delete(User $user, Department $department)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function restore(User $user, Department $department)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function forceDelete(User $user, Department $department)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
}
