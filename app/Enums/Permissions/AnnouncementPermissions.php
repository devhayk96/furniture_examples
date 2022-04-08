<?php

namespace App\Enums\Permissions;

class AnnouncementPermissions extends BasePermissions
{
    // Right to view announcements
    const VIEW = 'announcements view';

    // Right to create announcements
    const CREATE = 'announcements create';

    // Right to change announcements
    const UPDATE = 'announcements update';

    // Right to delete announcements
    const DELETE = 'announcements delete';

}
