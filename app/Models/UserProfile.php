<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'user_profile';

    protected $fillable = [
        'user_id',
        'gender',
        'birthdate',
        'avatar',
        'viber',
        'whatsapp',
        'telegram'
    ];

    const DEFAULT_AVATAR_PATH = 'images/default-avatar.png';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
