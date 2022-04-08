<?php


namespace App\Enums;

/**
 * Class AnnouncementsEnum
 * @package App\Enums
 */
class AnnouncementsEnum
{
    public const PENDING = 2;
    public const ACTIVE = 1;
    public const ARCHIVE = 0;
    public const REJECTED = -1;

    public const STATUSES = [
        'pending' => self::PENDING,
        'active' => self::ACTIVE,
        'archive' => self::ARCHIVE,
        'rejected' => self::REJECTED,
    ];
}
