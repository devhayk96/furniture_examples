<?php

namespace App\Helpers\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public static function getAuthUser()
    {
        if(!admin_is_logged_in()) {
            throw new \Exception('admin not authenticated');
        }

        return current_admin();
    }
}
