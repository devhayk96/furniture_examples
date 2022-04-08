<?php

namespace App\Models;

use App\Enums\AnnouncementsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    const CURRENCIES = [
        'AMD', 'USD', 'EUR'
    ];
    protected $fillable = [
        'category_id','sub_category_id','title_am', 'title_en', 'title_ru','description','slug','status'
    ];
    public static function fields() {
        return [
            'id' => ['type' => 'field'],
            'title_'.app()->getLocale() => ['type' => 'field'],
            'admin' => [
                'type' => 'relation',
                'fields' => ['full_name'],
            ],
            'category' => [
                'type' => 'relation',
                'fields' => ['category_title'],
            ],

        ];
    }

    public function getTitleAttribute(){
        return $this['title_'.app()->getLocale()];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function details()
    {
        return $this->hasOne(AnnouncementDetail::class,'announcement_id');
    }

    public function additional_infos()
    {
        return $this->belongsToMany(
            AdditionalInfo::class,
            'announcement_additional_infos',
            'announcement_id',
            'additional_info_id'
        );
    }

    public function additional_info_ids()
    {
        return $this->additional_infos()->pluck('additional_info_id')->toArray();
    }

    public function deal_types()
    {
        return $this->belongsToMany(
            DealType::class,
            'announcement_deal_types',
            'announcement_id',
            'deal_type_id'
        );
    }

    public function announcement_files()
    {
        return $this->hasMany(AnnouncementFile::class,'announcement_id');
    }

    public function getMainImageAttribute(){
        $image = $this->announcement_files()->where(['is_main' => 1])->first();
//        if ($this->announcement_files()->count()){
//            $image = $this->announcement_files()->first();
//        }
        return $image ? ('storage/' . $image->path) : '/images/announcement/default.png';
    }

    public function deal_type_ids()
    {
        return $this->deal_types()->pluck('deal_type_id')->toArray();
    }

    public function deal_type($deal_type_id)
    {
        return AnnouncementDealType::where([
            'announcement_id' => $this->id,
            'deal_type_id' => $deal_type_id
        ])->first();
    }

    public function filters()
    {
        return ['admin' => Admin::all(),'category' => Category::all()];
    }

    public function active(){
        return $this->status == AnnouncementsEnum::ACTIVE;
    }

    public function archive(){
        return $this->status == AnnouncementsEnum::ARCHIVE;
    }

    public function pending(){
        return $this->status == AnnouncementsEnum::PENDING;
    }

    public function rejected(){
        return $this->status == AnnouncementsEnum::REJECTED;
    }

}
