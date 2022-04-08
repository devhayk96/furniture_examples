<?php

namespace App\Repositories\Permission\Enum;

use App\Enums\Permissions\ActivityLogPermissions;
use App\Enums\Permissions\AdditionalInfoPermissions;
use App\Enums\Permissions\AdminPermissions;
use App\Enums\Permissions\AnnouncementPermissions;
use App\Enums\Permissions\BuildingFloorPermissions;
use App\Enums\Permissions\BuildingTypePermissions;
use App\Enums\Permissions\CategoryPermissions;
use App\Enums\Permissions\ContactUsPermissions;
use App\Enums\Permissions\DealTypePermissions;
use App\Enums\Permissions\PagePermissions;
use App\Enums\Permissions\RepairingTypePermissions;
use App\Enums\Permissions\RolePermissions;
use App\Enums\Permissions\ServicePermissions;
use App\Enums\Permissions\UserRolePermissions;
use App\Enums\Permissions\StreetPermissions;
use App\Enums\Permissions\UserPermissions;
use App\Enums\Permissions\WebsiteInfoPermissions;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\RepositoryInterface;

class DiscoveredPermissionRepository implements RepositoryInterface
{
    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return collect(
            [
                'activity-logs'    => ActivityLogPermissions::get(),
                'additional-info'  => AdditionalInfoPermissions::get(),
                'admins'           => AdminPermissions::get(),
                'announcements'    => AnnouncementPermissions::get(),
                'building_floors'  => BuildingFloorPermissions::get(),
                'building_types'   => BuildingTypePermissions::get(),
                'categories'       => CategoryPermissions::get(),
                'contact-us'       => ContactUsPermissions::get(),
                'deal_types'       => DealTypePermissions::get(),
                'pages'            => PagePermissions::get(),
                'repairing_types'  => RepairingTypePermissions::get(),
                'roles'            => RolePermissions::get(),
                'services'         => ServicePermissions::get(),
                'user-roles'       => UserRolePermissions::get(),
                'users'            => UserPermissions::get(),
                'streets'          => StreetPermissions::get(),
                'website_info'     => WebsiteInfoPermissions::get(),
            ]
        );
    }

}
