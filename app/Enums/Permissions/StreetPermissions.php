<?php


namespace App\Enums\Permissions;


class StreetPermissions extends BasePermissions
{
    // Right to view streets
    const VIEW = 'streets view';

    // Right to create streets
    const CREATE = 'streets create';

    // Right to change streets
    const UPDATE = 'streets update';

    // Right to delete streets
    const DELETE = 'streets delete';
}
