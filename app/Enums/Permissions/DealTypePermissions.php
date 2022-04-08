<?php

namespace App\Enums\Permissions;

class DealTypePermissions extends BasePermissions
{
    // Right to view deal-types
    const VIEW = 'deal-types view';

    // Right to create deal-types
    const CREATE = 'deal-types create';

    // Right to change deal-types
    const UPDATE = 'deal-types update';

    // Right to delete deal-types
    const DELETE = 'deal-types delete';

}
