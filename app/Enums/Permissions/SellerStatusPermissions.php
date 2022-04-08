<?php

namespace App\Enums\Permissions;

class SellerStatusPermissions extends BasePermissions
{
    // Right to view statuses
    const VIEW = 'seller-statuses view';

    // Right to create statuses
    const CREATE = 'seller-statuses create';

    // Right to change statuses
    const UPDATE = 'seller-statuses update';

    // Right to delete statuses
    const DELETE = 'seller-statuses delete';

}
