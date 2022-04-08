<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles, LogsActivity, SoftDeletes;

    protected $guard_name = 'admin';
    protected static $logName = 'admin';
    protected static $logAttributes = ['full_name', 'email'];


    protected $guard = 'admin';
//    protected $guarded = array();

    protected $fillable = [
        'full_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    const ROLE_SUPER_ADMIN = 1;
    const ROLE_ADMIN = 2;
    const ROLE_BROKER = 3;

    const ROLES = [
        self::ROLE_SUPER_ADMIN => [
            'name' => 'Սուպեր ադմին',
            'name_en' => 'Super Admin',
            'name_ru' => 'Супер Админ',
        ],
        self::ROLE_ADMIN => [
            'name' => 'Ադմին',
            'name_en' => 'Admin',
            'name_ru' => 'Админ',
        ],
        self::ROLE_BROKER => [
            'name' => 'Բրոկեր',
            'name_en' => 'Broker',
            'name_ru' => 'Брокер',
        ],
    ];

    public static function fields(){

        return [
            'id' => ['type' => 'field'],
            'full_name' => ['type' => 'field'],
            'email' => ['type' => 'field'],

            'profile' => [
                'type' => 'relation',
                'fields' => ['gender','age','phone'],

            ],
            'role' => [
                'type' => 'relation',
                'fields' => ['role_name'],
            ],

        ];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'integer',
    ];

    /**
     * @return HasOne
     */
    public  function profile()
    {
        return $this->hasOne(AdminProfile::class);
    }

    public function role()
    {
        return $this->belongsToMany(AdminRole::class,'model_has_roles','role_id','model_id');
    }

    public function scopeFilter(Builder $query,$request){
        $role = $request['role'];
        $search = $request['search'];
        if ($role && $role != ''){
            $query = $query->role($role);
        }
        if ($search && $search != ''){
            $query = $query->where(function ($q) use ($search){
                $q
                    ->where('id', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('full_name', 'like', '%' . $search . '%');
            })->orWhereHas('profile',function ($q) use ($search){
                $q->where('phone', 'like', '%' . $search . '%');
            });
        }
        $query = $query->with([
            'profile'
        ]);

        return $query;
    }


    /**
     * Save password with hashed way
     * @param $value
     */
//    public function setPasswordAttribute($value)
//    {
//        $this->attributes['password'] = Hash::make($value ?? Str::random(8));
//    }

    /**
     * Get age from birth date
     * @return int
     */
    public function getAgeAttribute()
    {
        return $this->profile ? Carbon::parse($this->profile->birthdate)->age : '';
    }

    public function getAvatarAttribute()
    {
        return $this->profile && $this->profile->avatar ? $this->profile->avatar : AdminProfile::DEFAULT_AVATAR_PATH;
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = Auth::guard('admin')->check() ? Auth::guard('admin')->id() : 1;
        $activity->causer_type = config('auth.providers')['admins']['model'];
    }

    public function announcements(){
        return $this->hasMany(Announcement::class,'admin_id');
    }
}
