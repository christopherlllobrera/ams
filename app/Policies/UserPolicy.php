<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //return $user->hasRole('superadmin');
        if ($user->hasPermissionTo('view-user')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user)
    {
        //return $user->hasRole('admin');
        if ($user->hasPermissionTo('view-user')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //return $user->hasRole('admin');
        if ($user->hasPermissionTo('create-user')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        //return $user->hasRole('admin');
        if ($user->hasPermissionTo('update-user')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        //return $user->hasRole('admin');
        if ($user->hasPermissionTo('delete-user')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user)
    {
        return $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user)
    {
        return $user->hasRole('superadmin');
    }
}
