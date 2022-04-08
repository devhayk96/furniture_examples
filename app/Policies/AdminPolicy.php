<?php

namespace App\Policies;

use App\Enums\Permissions\AdminPermissions;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the admin.
     *
     * @param Admin|null $admin
     * @return mixed
     */
    public function view(?Admin $admin)
    {
        return $admin->hasPermissionTo(AdminPermissions::VIEW);
    }

    /**
     * Determine whether the admin can create admins.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->can(AdminPermissions::CREATE)) {
            return true;
        }
    }

    /**
     * Determine whether the admin can update the admin.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        if ($admin->can(AdminPermissions::UPDATE)) {
            return true;
        }
    }

    /**
     * Determine whether the admin can delete the admin.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        if ($admin->can(AdminPermissions::DELETE)) {
            return true;
        }
    }

    /**
     * Determine whether the admin can restore the admin.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function restore(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the admin.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function forceDelete(Admin $admin)
    {
        //
    }
}
