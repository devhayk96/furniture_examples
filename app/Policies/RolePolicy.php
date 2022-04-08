<?php

namespace App\Policies;

use App\Enums\Permissions\RolePermissions;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the role.
     *
     * @param Admin|null $admin
     * @return mixed
     */
    public function view(?Admin $admin)
    {
        return $admin->hasPermissionTo(RolePermissions::VIEW);
    }

    /**
     * Determine whether the admin can create roles.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->can(RolePermissions::CREATE)) {
            return true;
        }
    }

    /**
     * Determine whether the admin can update the role.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        if ($admin->can(RolePermissions::UPDATE)) {
            return true;
        }
    }

    /**
     * Determine whether the admin can delete the role.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        if ($admin->can(RolePermissions::DELETE)) {
            return true;
        }
    }

    /**
     * Determine whether the admin can restore the role.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function restore(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the role.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function forceDelete(Admin $admin)
    {
        //
    }
}
