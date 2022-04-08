<?php

namespace App\Enums\Permissions;

class UserRolePermissions extends BasePermissions
{
    // Right to view user-roles
    const VIEW = 'user-roles view';

    /*// Right to create user-roles
    const CREATE = 'user-roles create';*/

    // Right to change user-roles
    const UPDATE = 'user-roles update';

    /*// Right to delete user-roles
    const DELETE = 'user-roles delete';*/

    /**
     * @return array
     */
    public static function get(): array
    {
        return [
            static::VIEW   => static::getLabel(static::VIEW),
            static::UPDATE => static::getLabel(static::UPDATE),
        ];
    }
}
