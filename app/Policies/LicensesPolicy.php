<?php

namespace App\Policies;

use App\Models\Licenses;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LicensesPolicy
{

    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo('view-license')) {
            return true;
        }
        return false;
    }

    public function view(User $user, Licenses $licenses)
    {
        if ($user->hasPermissionTo('view-license')) {
            return true;
        }
        return false;
    }
    public function create(User $user)
    {
        if ($user->hasPermissionTo('create-license')) {
            return true;
        }
        return false;
    }

    public function update(User $user, Licenses $licenses)
    {
        if ($user->hasPermissionTo('update-license')) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Licenses $licenses)
    {
        if ($user->hasPermissionTo('delete-license')) {
            return true;
        }
        return false;
    }

    public function restore(User $user, Licenses $licenses)
    {
        if ($user->hasPermissionTo('restore-license')) {
            return true;
        }
        return false;
    }

    public function forceDelete(User $user, Licenses $licenses)
    {
        if ($user->hasPermissionTo('force-delete-license')) {
            return true;
        }
        return false;
    }
}
