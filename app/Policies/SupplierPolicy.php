<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function view(User $user, Supplier $supplier)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function create(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function update(User $user, Supplier $supplier)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function delete(User $user, Supplier $supplier)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function restore(User $user, Supplier $supplier)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function forceDelete(User $user, Supplier $supplier)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
}
