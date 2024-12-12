<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssetPolicy
{
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo('view-user')) {
            return true;
        }
        return false;

    }
    public function view(User $user, Asset $asset)
    {
        if ($user->hasPermissionTo('view-asset')) {
            return true;
        }
        return false;
    }
    public function create(User $user)
    {
        if ($user->hasPermissionTo('create-asset')) {
            return true;
        }
        return false;
    }

    public function update(User $user, Asset $asset)
    {
        if ($user->hasPermissionTo('update-asset')) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Asset $asset)
    {
        if ($user->hasPermissionTo('delete-asset')) {
            return true;
        }
        return false;
    }

    public function restore(User $user, Asset $asset)
    {
        if ($user->hasPermissionTo('restore-asset')) {
            return true;
        }
        return false;
    }

    public function forceDelete(User $user, Asset $asset)
    {
        if ($user->hasPermissionTo('force-delete-asset')) {
            return true;
        }
        return false;
    }
}
