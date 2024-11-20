<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{

    public function viewAny(User $user)
    {
        return $user->hasRole('superadmin');
    }

    public function view(User $user, Role $role)
    {
        return $user->hasRole('superadmin');
    }
    public function create(User $user)
    {
        return $user->hasRole('superadmin');
    }

    public function update(User $user, Role $role)
    {
        return $user->hasRole('superadmin');
    }

    public function delete(User $user, Role $role)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, Role $role)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Role $role)
    {
        return $user->hasRole('superadmin');
    }
}
