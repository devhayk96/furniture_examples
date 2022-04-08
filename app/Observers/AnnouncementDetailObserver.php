<?php

namespace App\Observers;

use App\Models\AnnouncementDetail;

class AnnouncementDetailObserver
{
    public function saved(AnnouncementDetail $detail){
        $title_am = '';
        $title_en = '';
        $title_ru = '';
        $announcement = $detail->announcement;
        if (in_array($announcement->category_id,[1,2])){
            if ($detail->rooms){
                $title_am = $detail->rooms . ' սենյականոց ';
                $title_en = $detail->rooms . '-room ';
                $title_ru = $detail->rooms . '-комнатная ';
            }
            $title_am .= mb_strtolower($announcement->category->title_am);
            $title_en .= mb_strtolower($announcement->category->title_en);
            $title_ru .= mb_strtolower($announcement->category->title_ru);

            if ($detail->street){
                $street_am = $detail->street->title_am;
                $street_am = str_replace('փ.' , '',$street_am);
                $street_am = str_replace('փողոց' , '',$street_am);
                $title_am .= ' ' . $street_am . ' փողոցում';
                $title_en .= ' in Yerevan';
                $title_ru .= ' в Ереване';
            }elseif ($detail->city){
                $title_am .= ' քաղաք ' . $detail->city->title_am . 'ում';
                $title_en .= ' in ' . $detail->city->title_en;
                $title_ru .= ' в ' . $detail->city->title_ru;
            }elseif ($detail->village){
                $title_am .= ' գյուղ ' . $detail->village->title_am . 'ում';
                $title_en .= ' in ' . $detail->village->title_en;
                $title_ru .= ' в ' . $detail->village->title_ru;
            }elseif ($detail->region){
                if ($detail->region->id == 11){
                    $title_am .= ' ' . $detail->region->title_am . 'ում';
                }else{
                    $title_am .= ' ' . $detail->region->title_am . 'ի մարզում';
                }
            }
        }
        $slug = str_replace(' ', '-',strtolower($title_en)) . '-' . $announcement->id;
        $announcement->update([
            'title_am' => $title_am,
            'title_en' => $title_en,
            'title_ru' => $title_ru,
            'slug' => $slug
        ]);
    }

    public function updating(AnnouncementDetail $detail){
        dd($detail);
    }
}
