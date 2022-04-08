<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'services';

    protected static $logFillable = true;

    protected static $logName = 'service';

    protected $fillable = [
        'icon',
        'menu_title_am',
        'menu_title_en',
        'menu_title_ru',
        'page_title_am',
        'page_title_en',
        'page_title_ru',
        'desc_am',
        'desc_en',
        'desc_ru',
    ];


    public static function fields()
    {
        return [
            'id' => ['type' => 'field'],
            'menu_title_'.app()->getLocale() => ['type' => 'field'],
            'page_title_'.app()->getLocale() => ['type' => 'field'],
            'desc_'.app()->getLocale() => ['type' => 'field','class' => 'desc-content'],
        ];
    }

    public function scopeFilter(Builder $query,$request)
    {
        $search = $request['search'];
        if ($search && $search != ''){
            $query = $query->where(function ($q) use ($search){
                $q->where('menu_title_'.app()->getLocale(), 'like', '%' . $search . '%')
                    ->orWhere('page_title_'.app()->getLocale(), 'like', '%' . $search . '%')
                    ->orWhere('desc_'.app()->getLocale(), 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = Auth::guard('admin')->check() ? Auth::guard('admin')->id() : 1;
        $activity->causer_type = config('auth.providers')['admins']['model'];
    }
}
