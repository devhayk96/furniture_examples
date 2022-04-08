<?php

namespace App\Enums;

/**
 * Menu Item links and names
 */
class MenuItemsEnum implements EnumInterface
{

    /**
     * @return array|array[]
     */
    public static function all(): array
    {
        return [
            'dashboard.index'        => 'admin.dashboard',
            'pages.index'            => 'admin.pages',
            'contact-us.index'       => 'admin.contact-us',
            'categories.index'       => 'admin.categories',
//            'seller-statuses.index'  => 'admin.seller-statuses',
            'services.index'         => 'admin.services',
            'announcements.index'    => 'admin.announcements',
            'building-types.index'   => 'admin.building_types',
            'building-floors.index'  => 'admin.building_floors',
            'repairing-types.index'  => 'admin.repairing_types',
            'deal-types.index'       => 'admin.deal_types',
            'streets.index'          => 'admin.streets',
            'additional-infos.index' => 'admin.additional-info',
            'activity-logs.index'    => 'admin.activity-logs',
            'users.index'            => 'admin.users',
            'user-roles.index'       => 'admin.user-roles',
            'admins.index'           => 'admin.admins',
            'roles.index'            => 'admin.roles',
            'website-info.index'     => 'admin.website_info',
        ];
    }

}
