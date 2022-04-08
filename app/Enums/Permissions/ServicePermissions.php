<?php

namespace App\Enums\Permissions;

class ServicePermissions extends BasePermissions
{
    // Right to view services
    const VIEW = 'services view';

    // Right to create services
    const CREATE = 'services create';

    // Right to change services
    const UPDATE = 'services update';

    // Right to delete services
    const DELETE = 'services delete';

}
