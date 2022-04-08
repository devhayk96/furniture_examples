<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class DealType extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = "deal_types";
    protected $fillable = ['title_am','title_en','title_ru'];
    public static $fields = [
        'id' => 'field',
        'title_am' => 'field',
        'title_en' => 'field',
        'title_ru' => 'field',
    ];
    protected static $logName = 'deal_type';
    protected static $logFillable = true;

    public static function fields(){

        return [
            'id' => ['type' => 'field'],
            'title_am' => ['type' => 'field'],
            'title_en' => ['type' => 'field'],
            'title_ru' => ['type' => 'field'],
        ];
    }

    public function scopeFilter(Builder $query,$request){
        $search = $request['search'];
        if ($search && $search != ''){
            $query = $query->where(function ($q) use ($search){
                $q->where('title_am', 'like', '%' . $search . '%')
                    ->orWhere('title_en', 'like', '%' . $search . '%')
                    ->orWhere('title_ru', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = Auth::guard('admin')->check() ? Auth::guard('admin')->id() : 1;
        $activity->causer_type = config('auth.providers')['admins']['model'];
    }
}
