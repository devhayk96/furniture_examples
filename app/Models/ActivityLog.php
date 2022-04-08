<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
    public static function fields(){

        return [
            'id' => ['type' => 'field'],
            'log_name' => ['type' => 'field'],
            'description' => ['type' => 'field'],
            'subject_type' => ['type' => 'field'],
            'properties' => ['type' => 'field'],
        ];
    }

}
