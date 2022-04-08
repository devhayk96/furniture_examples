<?php

namespace App\Models;

use Spatie\Permission\Models\Permission;

class AdminPermission extends Permission
{
    protected $appends = [
        'action_name'
    ];

    const PERMISSION_ACTION_NAMES = array(
        'view',
        'create',
        'update',
        'delete'
    );

    public static function allByGroupName()
    {
        $permissions = array();

        self::all()->map(function($permission) use (&$permissions) {
            if ($permission['group_name']) {
                if (!isset($permissions[$permission['group_name']])) {
                    $permissions[$permission['group_name']] = array();
                }
                $permissions[$permission['group_name']][] = $permission;
            } else {
                $permissions[] = $permission;
            }
        });

        return $permissions;
    }

    public function getActionNameAttribute()
    {
        $value = $this->attributes['name'];

        foreach (AdminPermission::PERMISSION_ACTION_NAMES as $action_name) {
            if (str_contains($value, $action_name)) {
                $value = $action_name;
            }
        }
        return $value;
    }
}
