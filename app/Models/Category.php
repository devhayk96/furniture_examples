<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title_am',
        'title_en',
        'title_ru',
        'parent_id'
    ];

    public static function fields()
    {
        return [
            'id' => ['type' => 'field'],
            'title_am' => ['type' => 'field'],
            'title_en' => ['type' => 'field'],
            'title_ru' => ['type' => 'field'],
            'parent' => [
                'type' => 'relation',
                'fields' => ['parent_title'],
            ],

        ];
    }

    protected static $logFillable = true;

    protected static $logName = 'category';

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function formItems()
    {
        $data = [
            'statuses' => SellerStatus::all(),
            'deal_types' => DealType::all(),
            'first_line' => false,
            'building' => true,
            'address' => false,
            'subcategories' => null,
            'building_types' => BuildingType::all(),
            'from_constructor' => true,
            'building_floors' => BuildingFloor::all(),
            'multiple_building_floors' => false,
            'floors_count' => 25,
            'rooms' => 10,
            'bathrooms' => 5,
            'ceiling_height' => true,
            'ceiling_heights' => [],
            'has_balcony' => false,
            'total_area' => true,
            'land_area' => false,
            'forehead_length' => false,
            'depth' => false,
            'demolition' => false,
            'separate_building' => false,
            'repairing_types' => RepairingType::all(),
            'additional' => AdditionalInfo::all()->chunk(4),
            'regions' => Region::all(),
            'cities' => City::all(),
            'villages' => Village::all(),

        ];


        switch ($this->id){
            case 1:
                $data['has_balcony'] = true;
                $data['ceiling_heights'] = [2.6,2.75,3,3.5];
                break;
            case 2:
                $data['land_area'] = true;
                $data['floors_count'] = 0;
                $data['multiple_building_floors'] = true;
                break;
            case 3:
                $data['deal_types'] = DealType::whereIn('id',[1,2])->get();
                $data['first_line'] = true;
                $data['subcategories'] = $this->subcategories()->get();
                $data['rooms'] = 0;
                $data['land_area'] = true;
                $data['separate_building'] = true;
                break;
            case 4:
                $data['deal_types'] = DealType::whereIn('id',[1])->get();
                $data['first_line'] = true;
                $data['building'] = false;
                $data['address'] = true;
                $data['subcategories'] = $this->subcategories()->get();
                $data['building_types'] = null;
                $data['from_constructor'] = false;
                $data['building_floors'] = [];
                $data['floors_count'] = 0;
                $data['rooms'] = 0;
                $data['bathrooms'] = 0;
                $data['ceiling_height'] = false;
                $data['forehead_length'] = true;
                $data['depth'] = true;
                $data['demolition'] = true;
                $data['repairing_types'] = null;
                break;
        }
        return $data;
    }

    public function filters()
    {
        return ['parent' => Category::all()];
    }

    public function scopeFilter(Builder $query, Request $request)
    {
        $parent = $request->get('parent');
        $search = $request->get('search');
        if ($parent && $parent != ''){
            $query = $query->where(['parent_id' => $parent]);
        }
        if ($search && $search != ''){
            $query = $query->where(function ($q) use ($search){
                  $q->where('title_am', 'like', '%' . $search . '%')
                    ->orWhere('title_en', 'like', '%' . $search . '%')
                    ->orWhere('title_ru', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    /**
     * @return HasMany
     */
    public function subcategories()
    {
        return $this->hasMany(self::class,'parent_id');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = Auth::guard('admin')->check() ? Auth::guard('admin')->id() : 1;
        $activity->causer_type = config('auth.providers')['admins']['model'];
    }
}
