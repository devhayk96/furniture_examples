<?php

namespace App\Enums\Permissions;

class BuildingFloorPermissions extends BasePermissions
{
    // Right to view building-floors
    const VIEW = 'building-floors view';

    // Right to create building-floors
    const CREATE = 'building-floors create';

    // Right to change building-floors
    const UPDATE = 'building-floors update';

    // Right to delete building-floors
    const DELETE = 'building-floors delete';

}
