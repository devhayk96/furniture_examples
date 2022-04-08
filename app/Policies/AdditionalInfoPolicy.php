<?php

namespace App\Policies;

use App\Enums\Permissions\PagePermissions;
use App\Models\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdditionalInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the page can view the page.
     *
     * @param Page|null $page
     * @return mixed
     */
    public function view(?Page $page)
    {
        return $page->hasPermissionTo(PagePermissions::VIEW);
    }

    /**
     * Determine whether the page can create pages.
     *
     * @param Page $page
     * @return mixed
     */
    public function create(Page $page)
    {
        if ($page->can(PagePermissions::CREATE)) {
            return true;
        }
    }

    /**
     * Determine whether the page can update the page.
     *
     * @param Page $page
     * @return mixed
     */
    public function update(Page $page)
    {
        if ($page->can(PagePermissions::UPDATE)) {
            return true;
        }
    }

    /**
     * Determine whether the page can delete the page.
     *
     * @param Page $page
     * @return mixed
     */
    public function delete(Page $page)
    {
        if ($page->can(PagePermissions::DELETE)) {
            return true;
        }
    }

    /**
     * Determine whether the page can restore the page.
     *
     * @param Page $page
     * @return mixed
     */
    public function restore(Page $page)
    {
        //
    }

    /**
     * Determine whether the page can permanently delete the page.
     *
     * @param Page $page
     * @return mixed
     */
    public function forceDelete(Page $page)
    {
        //
    }
}
