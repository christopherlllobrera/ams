<?php

namespace App\Policies;

use App\Models\AssetLifeCycle;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssetLifeCyclePolicy
{

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function view(User $user, AssetLifeCycle $assetLifeCycle)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function create(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function update(User $user, AssetLifeCycle $assetLifeCycle)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function delete(User $user, AssetLifeCycle $assetLifeCycle)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function restore(User $user, AssetLifeCycle $assetLifeCycle)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function forceDelete(User $user, AssetLifeCycle $assetLifeCycle)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
}
