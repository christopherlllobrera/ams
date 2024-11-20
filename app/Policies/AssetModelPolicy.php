<?php

namespace App\Policies;

use App\Models\AssetModel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssetModelPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function view(User $user, AssetModel $assetModel)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function create(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function update(User $user, AssetModel $assetModel)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function delete(User $user, AssetModel $assetModel)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function restore(User $user, AssetModel $assetModel)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function forceDelete(User $user, AssetModel $assetModel)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
}
