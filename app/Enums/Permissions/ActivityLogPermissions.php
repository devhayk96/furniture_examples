<?php

namespace App\Enums\Permissions;

class ActivityLogPermissions extends BasePermissions
{
    // Right to view activity-log
    const VIEW = 'activity-logs view';

    // Right to create activity-log
    const CREATE = 'activity-logs create';

    // Right to change activity-log
    const UPDATE = 'activity-logs update';

    // Right to delete activity-log
    const DELETE = 'activity-logs delete';

}
