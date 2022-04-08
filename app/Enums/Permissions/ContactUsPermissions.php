<?php

namespace App\Enums\Permissions;

class ContactUsPermissions extends BasePermissions
{
    // Right to view contact-us
    const VIEW = 'contact-us view';

//    // Right to create contact-us
//    const CREATE = 'contact-us create';

//    // Right to change contact-us
//    const UPDATE = 'contact-us update';

    // Right to delete contact-us
    const DELETE = 'contact-us delete';


    /**
     * @return array
     */
    public static function get(): array
    {
        return [
            static::VIEW   => static::getLabel(static::VIEW),
            static::DELETE => static::getLabel(static::DELETE),
        ];
    }
}
