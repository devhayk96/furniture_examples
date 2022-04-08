<?php

namespace App\Enums\Permissions;

class UserPermissions extends BasePermissions
{
    // Right to view users
    const VIEW = 'users view';

    // Right to create users
    const CREATE = 'users create';

    // Right to change users
    const UPDATE = 'users update';

    // Right to delete users
    const DELETE = 'users delete';

}
