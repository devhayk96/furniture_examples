<?php

namespace App\Policies;

use App\Enums\Permissions\UserPermissions;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param User|null $user
     * @return mixed
     */
    public function view(?User $user)
    {
        return $user->hasPermissionTo(UserPermissions::VIEW);
    }

    /**
     * Determine whether the user can create users.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can(UserPermissions::CREATE)) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->can(UserPermissions::UPDATE)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->can(UserPermissions::DELETE)) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the user.
     *
     * @param User $user
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user.
     *
     * @param User $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
