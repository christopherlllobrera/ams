<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function viewAny(User $user)
    {
        //return $user->hasRole('superadmin');
        if ($user->hasPermissionTo('view-user')) {
            return true;
        }
        return false;
    }

    public function view(User $user)
    {
        //return $user->hasRole('admin');
        if ($user->hasPermissionTo('view-user')) {
            return true;
        }
        return false;
    }
    public function create(User $user)
    {
        //return $user->hasRole('admin');
        if ($user->hasPermissionTo('create-user')) {
            return true;
        }
        return false;
    }

    public function update(User $user)
    {
        //return $user->hasRole('admin');
        if ($user->hasPermissionTo('update-user')) {
            return true;
        }
        return false;
    }

    public function delete(User $user)
    {
        //return $user->hasRole('admin');
        if ($user->hasPermissionTo('delete-user')) {
            return true;
        }
        return false;
    }

    public function restore(User $user)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user)
    {
        return $user->hasRole('superadmin');
    }
}
