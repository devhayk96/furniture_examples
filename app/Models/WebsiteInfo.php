<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class WebsiteInfo extends Model
{
    use HasFactory,LogsActivity;
    protected $table = "website_info";
    protected $fillable = [
        'email',
        'address_am',
        'address_en',
        'address_ru',
        'phone_number',
        'office_phone_number',
        'footer_links',
        'photo_service',
    ];
    public static $fields = [
        'id' => 'field',
        'email' => 'field',
        'address_en' => 'field',
        'phone_number' => 'field',
    ];
    protected static $logFillable = true;
    protected static $logName = 'website_info';

    public static function fields(){

        return [
            'id' => ['type' => 'field'],
            'email' => ['type' => 'field'],
            'address_en' => ['type' => 'field'],
            'phone_number' => ['type' => 'field'],
        ];
    }

    public function scopeFilter(Builder $query,$request){
        $search = $request['search'];
        if ($search && $search != ''){
            $query = $query->where(function ($q) use ($search){
                $q->where('email', 'like', '%' . $search . '%')
                    ->orWhere('address_en', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    public function setFooterLinksAttribute($value)
    {
        $this->attributes['footer_links'] = json_encode($value);
    }

    public function getFooterLinksAttribute($value)
    {
        return json_decode($value);
    }

    public function setPhotoServiceAttribute($value)
    {
        $this->attributes['photo_service'] = json_encode($value);
    }

    public function getPhotoServiceAttribute($value)
    {
        return json_decode($value);
    }
}
