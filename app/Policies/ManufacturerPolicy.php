<?php

namespace App\Policies;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ManufacturerPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function view(User $user, Manufacturer $manufacturer)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function create(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function update(User $user, Manufacturer $manufacturer)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function delete(User $user, Manufacturer $manufacturer)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function restore(User $user, Manufacturer $manufacturer)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function forceDelete(User $user, Manufacturer $manufacturer)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);

    }
}
