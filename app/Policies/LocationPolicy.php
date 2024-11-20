<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LocationPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function view(User $user, Location $location)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);

    }
    public function create(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function update(User $user, Location $location)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function delete(User $user, Location $location)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function restore(User $user, Location $location)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function forceDelete(User $user, Location $location)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
}
