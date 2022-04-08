<?php

namespace App\Policies;

use App\Enums\Permissions\AnnouncementPermissions;
use App\Models\Announcement;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any announcements.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo(AnnouncementPermissions::VIEW);
    }

    /**
     * Determine whether the admin can view the announcement.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        return $admin->hasPermissionTo(AnnouncementPermissions::VIEW);
    }

    /**
     * Determine whether the admin can create announcements.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->can('announcement create')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can update the announcement.
     *
     * @param Admin $admin
     * @param Announcement $announcement
     * @return mixed
     */
    public function update(Admin $admin, Announcement $announcement)
    {
        if ($admin->can('announcement update')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can delete the announcement.
     *
     * @param Admin $admin
     * @param Announcement $announcement
     * @return mixed
     */
    public function delete(Admin $admin, Announcement $announcement)
    {
        if ($admin->can('announcement delete')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can restore the announcement.
     *
     * @param Admin $admin
     * @param Announcement $announcement
     * @return mixed
     */
    public function restore(Admin $admin, Announcement $announcement)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the announcement.
     *
     * @param Admin $admin
     * @param Announcement $announcement
     * @return mixed
     */
    public function forceDelete(Admin $admin, Announcement $announcement)
    {
        //
    }
}
