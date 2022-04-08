<?php

namespace App\Enums\Permissions;

class PagePermissions extends BasePermissions
{
    // Right to view pages
    const VIEW = 'pages view';

//    // Right to create pages
//    const CREATE = 'pages create';
//
    // Right to change pages
    const UPDATE = 'pages update';
//
//    // Right to delete pages
//    const DELETE = 'pages delete';


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
