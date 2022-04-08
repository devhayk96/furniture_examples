<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [
        'title_am',
        'desc_am',
        'title_en',
        'desc_en',
        'title_ru',
        'desc_ru',
        'image'
    ];

    public static function fields(){

        return [
            'id' => ['type' => 'field'],
            'title_am' => ['type' => 'field'],
            'title_en' => ['type' => 'field'],
            'title_ru' => ['type' => 'field'],
        ];
    }

    public function scopeFilter(Builder $query, $request)
    {
        if ($search = $request['search']){
            $query = $query->where(function ($q) use ($search){
                $q->where('title_'.app()->getLocale(), 'like', '%' . $search . '%')
                    ->orWhere('desc_'.app()->getLocale(), 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    protected static $logFillable = true;
    protected static $logName = 'page';

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = Auth::guard('admin')->check() ? Auth::guard('admin')->id() : 1;
        $activity->causer_type = config('auth.providers')['admins']['model'];
    }
}
