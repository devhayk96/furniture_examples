<?php

namespace App\Policies;

use App\Enums\Permissions\ServicePermissions;
use App\Models\Service;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any services.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo(ServicePermissions::VIEW);
    }

    /**
     * Determine whether the admin can view the service.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        return $admin->hasPermissionTo(ServicePermissions::VIEW);
    }

    /**
     * Determine whether the admin can create services.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->can('service create')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can update the service.
     *
     * @param Admin $admin
     * @param Service $service
     * @return mixed
     */
    public function update(Admin $admin, Service $service)
    {
        if ($admin->can('service update')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can delete the service.
     *
     * @param Admin $admin
     * @param Service $service
     * @return mixed
     */
    public function delete(Admin $admin, Service $service)
    {
        if ($admin->can('service delete')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can restore the service.
     *
     * @param Admin $admin
     * @param Service $service
     * @return mixed
     */
    public function restore(Admin $admin, Service $service)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the service.
     *
     * @param Admin $admin
     * @param Service $service
     * @return mixed
     */
    public function forceDelete(Admin $admin, Service $service)
    {
        //
    }
}
