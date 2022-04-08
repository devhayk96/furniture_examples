<?php

namespace Database\Seeders;

use App\Models\SellerStatus;
use Illuminate\Database\Seeder;

class SellerStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'title_am' => 'Սեփականատեր',
                'desc_am' => 'Եթե դուք վաճառում եք ձեւ սեփական անշարժ գույքը՝ սեփականատեր',
                'title_en' => 'Owner',
                'desc_en' => 'If You Are Selling Your Own Real Estate Form: Owner',
                'title_ru' => 'Владелец',
                'desc_ru' => 'Если вы продаете собственную форму недвижимости: Владелец'
            ],
            [
                'title_am' => 'Գործակալություն',
                'desc_am' => 'Եթե դուք միջնորդ եք, բրոքեր կամ անշարժ գույքի գործակալության ներկայացուցիչ',
                'title_en' => 'Agency',
                'desc_en' => 'If you are an mediator, broker or real estate agent',
                'title_ru' => 'Агентство',
                'desc_ru' => 'Если вы посредник, брокер или агент по недвижимости'
            ],
            [
                'title_am' => 'Կառուցապատող',
                'desc_am' => 'Եթե դուք վաճառում եք ձեր դեռ չկառուցված կամ կիսակառույց անշարժ գույքը՝ սեփականատեր',
                'title_en' => 'Developer',
                'desc_en' => 'If you are selling your undeveloped or unfinished real estate property, you are an owner',
                'title_ru' => 'Разработчик',
                'desc_ru' => 'Если вы продаете свою незастроенную или недостроенную недвижимость, владейте ею'
            ],

        ];
        SellerStatus::insert($statuses);
    }
}
