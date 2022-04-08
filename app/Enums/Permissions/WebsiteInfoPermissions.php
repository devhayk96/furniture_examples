<?php


namespace App\Enums\Permissions;


class WebsiteInfoPermissions extends BasePermissions
{
    // Right to view website-info
    const VIEW = 'website-info view';

    // Right to create website-info
    //const CREATE = 'website-info create';

    // Right to change website-info
    const UPDATE = 'website-info update';

    // Right to delete website-info
    //const DELETE = 'website-info delete';

    /**
     * @return array
     */
    public static function get(): array
    {
        return [
            static::VIEW   => static::getLabel(static::VIEW),
            static::UPDATE => static::getLabel(static::UPDATE),
        ];
    }
}
