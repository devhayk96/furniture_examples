<?php

namespace App\Models;

use App\Enums\StatusesEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'email_verified_at',
        'password',
        'status',
        'status_code',
        'provider',
        'provider_id',
        'provider_token',
        'provider_refresh_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var mixed
     */
    private $profile;

    /**
     * @return array
     */
    public static function fields(): array
    {
        return [
            'id' => ['type' => 'field'],
            'name' => ['type' => 'field'],
            'email' => ['type' => 'field'],

            'profile' => [
                'type' => 'relation',
                'fields' => ['gender', 'age', 'phone_number'],

            ],

        ];
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'status' => StatusesEnum::STATUSES['active'],
            'status_code' => null,
        ])->save();
    }

    /**
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * @return HasMany
     */
    public function phone(): HasMany
    {
        return $this->hasMany(UserPhoneNumber::class);
    }

    /**
     * Save password with hashed way
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value ?? Str::random(8));
    }

    /**
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        return $this->profile ? $this->profile->avatar : UserProfile::DEFAULT_AVATAR_PATH;
    }

    /**
     * @return HasMany
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class,'user_id');
    }
}
