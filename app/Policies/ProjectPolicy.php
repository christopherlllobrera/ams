<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);

    }

    public function view(User $user, Project $project)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
    public function create(User $user)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function update(User $user, Project $project)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function delete(User $user, Project $project)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }

    public function restore(User $user, Project $project)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);

    }

    public function forceDelete(User $user, Project $project)
    {
        return $user->hasAnyRole(['AMS-admin' , 'superadmin']);
    }
}
