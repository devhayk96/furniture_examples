<?php

namespace App\Enums\Permissions;

class AdminPermissions extends BasePermissions
{
    // Right to view admins
    const VIEW = 'admins view';

    // Right to create admins
    const CREATE = 'admins create';

    // Right to change admins
    const UPDATE = 'admins update';

    // Right to delete admins
    const DELETE = 'admins delete';

}
