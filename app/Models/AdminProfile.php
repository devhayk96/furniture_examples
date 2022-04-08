<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class AdminProfile extends Model
{
    use HasFactory,SoftDeletes, LogsActivity;

    protected $table = "admin_profile";
    protected static $logFillable = true;
    protected static $logName = 'profile';

    protected $fillable = [
        'admin_id',
        'gender',
        'birthdate',
        'avatar',
        'phone',
        'viber',
        'whatsapp',
        'telegram'
    ];

    const DEFAULT_AVATAR_PATH = 'backend/img/profile-img.jpg';
    const AVATAR_PATH = 'uploads/profile/';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }


    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = Auth::guard('admin')->check() ? Auth::guard('admin')->id() : 1;
        $activity->causer_type = config('auth.providers')['admins']['model'];
    }
}
