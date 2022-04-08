<?php

namespace App\Helpers\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccessHelper
{
    /**
     * @param $actions
     * @param  Model  $model
     * @return bool
     * @throws \Exception
     */
    public static function canOrFail($actions, Model $model): bool
    {
        if (!is_array($actions)) {
            $actions = [$actions];
        }

        foreach ($actions as $action) {
            if ((AuthHelper::getAuthUser())->can($action, $model)) {
                return true;
            }
        }

        abort(403, __('Access denied'));
    }

    /**
     * @param $actions
     * @param  Model  $model
     * @return bool
     * @throws \Exception
     */
    public static function isCan($actions, Model $model): bool
    {
        if(!admin_is_logged_in()) {
            return false;
        }

        if (!is_array($actions)) {
            $actions = [$actions];
        }

        foreach ($actions as $action) {
            if (AuthHelper::getAuthUser()->can($action, $model)) {
                return true;
            }
        }

        return false;
    }
}
