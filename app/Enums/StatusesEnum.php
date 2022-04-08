<?php

namespace App\Enums;

/**
 * Statuses
 */
class StatusesEnum
{
    public const ACTIVE_STATUS = 1;
    public const NOT_VERIFIED = 2;
    public const DELETED_STATUS = 0;
    public const DISABLED_STATUS = -1;

    public const STATUSES = [
        'active' => self::ACTIVE_STATUS,
        'deleted' => self::DELETED_STATUS,
        'disabled' => self::DISABLED_STATUS,
        'not_verified' => self::NOT_VERIFIED,
    ];

}
