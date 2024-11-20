<?php

namespace App\Policies;

use App\Models\Licenses;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LicensesPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function view(User $user, Licenses $licenses)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function create(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function update(User $user, Licenses $licenses)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function delete(User $user, Licenses $licenses)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function restore(User $user, Licenses $licenses)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function forceDelete(User $user, Licenses $licenses)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
}
