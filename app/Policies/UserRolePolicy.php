<?php

namespace App\Policies;

use App\Enums\Permissions\UserRolePermissions;
use App\Models\UserRole;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any statuses.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo(UserRolePermissions::VIEW);
    }

    /**
     * Determine whether the admin can view the status.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        return $admin->hasPermissionTo(UserRolePermissions::VIEW);
    }

    /**
     * Determine whether the admin can create statuses.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->can('status create')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can update the status.
     *
     * @param Admin $admin
     * @param UserRole $status
     * @return mixed
     */
    public function update(Admin $admin, UserRole $status)
    {
        if ($admin->can('status update')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can delete the status.
     *
     * @param Admin $admin
     * @param UserRole $status
     * @return mixed
     */
    public function delete(Admin $admin, UserRole $status)
    {
        if ($admin->can('status delete')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can restore the status.
     *
     * @param Admin $admin
     * @param UserRole $status
     * @return mixed
     */
    public function restore(Admin $admin, UserRole $status)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the status.
     *
     * @param Admin $admin
     * @param UserRole $status
     * @return mixed
     */
    public function forceDelete(Admin $admin, UserRole $status)
    {
        //
    }
}
