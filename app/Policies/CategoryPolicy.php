<?php

namespace App\Policies;

use App\Enums\Permissions\CategoryPermissions;
use App\Models\Category;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any categories.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo(CategoryPermissions::VIEW);
    }

    /**
     * Determine whether the admin can view the category.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        return $admin->hasPermissionTo(CategoryPermissions::VIEW);
    }

    /**
     * Determine whether the admin can create categories.
     *
     * @param Admin $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if ($admin->can('category create')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can update the category.
     *
     * @param Admin $admin
     * @param Category $category
     * @return mixed
     */
    public function update(Admin $admin, Category $category)
    {
        if ($admin->can('category update')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can delete the category.
     *
     * @param Admin $admin
     * @param Category $category
     * @return mixed
     */
    public function delete(Admin $admin, Category $category)
    {
        if ($admin->can('category delete')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can restore the category.
     *
     * @param Admin $admin
     * @param Category $category
     * @return mixed
     */
    public function restore(Admin $admin, Category $category)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the category.
     *
     * @param Admin $admin
     * @param Category $category
     * @return mixed
     */
    public function forceDelete(Admin $admin, Category $category)
    {
        //
    }
}
