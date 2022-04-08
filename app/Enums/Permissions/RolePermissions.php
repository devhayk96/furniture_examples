<?php

namespace App\Enums\Permissions;

class RolePermissions extends BasePermissions
{
    // Right to view roles
    const VIEW = 'roles view';

    // Right to create roles
    const CREATE = 'roles create';

    // Right to change roles
    const UPDATE = 'roles update';

    // Right to delete roles
    const DELETE = 'roles delete';

}
