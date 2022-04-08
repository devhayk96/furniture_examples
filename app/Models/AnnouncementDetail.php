<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'seller_status_type_id',
        'region_id',
        'city_id',
        'village_id',
        'district_id',
        'street_id',
        'building_address',
        'repairing_type_id',
        'building_type_id',
        'building_floor_ids',
        'commercial_area_type_id',
        'first_line',
        'building',
        'apartment',
        'total_area',
        'land_area',
        'ceil_height',
        'rooms',
        'bathrooms',
        'has_elevator',
        'has_balcony',
        'separate_building',
        'forehead_length',
        'depth',
        'demolition',
    ];
    public $timestamps = false;
    protected $casts = [
       'building_floor_ids' => 'object'
    ];

    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function village(){
        return $this->belongsTo(Village::class, 'village_id');
    }

    public function street(){
        return $this->belongsTo(Street::class,'street_id');
    }

    public function announcement(){
        return $this->belongsTo(Announcement::class,'announcement_id');
    }
}
