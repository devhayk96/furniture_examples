<?php

namespace App\Enums\Permissions;

class BuildingTypePermissions extends BasePermissions
{
    // Right to view building-types
    const VIEW = 'building-types view';

    // Right to create building-types
    const CREATE = 'building-types create';

    // Right to change building-types
    const UPDATE = 'building-types update';

    // Right to delete building-types
    const DELETE = 'building-types delete';

}
