<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => UserRole::OWNER_ID,
                'title_am' => 'Սեփականատեր',
                'desc_am' => 'Եթե դուք վաճառում եք ձեր սեփական անշարժ գույքը՝ սեփականատեր',
                'title_en' => 'Owner',
                'desc_en' => 'If you are selling your own real estate form: owner',
                'title_ru' => 'Владелец',
                'desc_ru' => 'Если вы продаете собственную форму недвижимости: Владелец'
            ],
            [
                'id' => UserRole::AGENCY_ID,
                'title_am' => 'Գործակալություն',
                'desc_am' => 'Եթե դուք միջնորդ եք, բրոքեր կամ անշարժ գույքի գործակալության ներկայացուցիչ',
                'title_en' => 'Agency',
                'desc_en' => 'If you are an mediator, broker or real estate agent',
                'title_ru' => 'Агентство',
                'desc_ru' => 'Если вы посредник, брокер или агент по недвижимости'
            ],
            [
                'id' => UserRole::BUILDER_ID,
                'title_am' => 'Կառուցապատող',
                'desc_am' => 'Եթե դուք վաճառում եք ձեր դեռ չկառուցված կամ կիսակառույց անշարժ գույքը՝ սեփականատեր',
                'title_en' => 'Builder',
                'desc_en' => 'If you are selling your undeveloped or unfinished real estate property, you are an owner',
                'title_ru' => 'Строитель',
                'desc_ru' => 'Если вы продаете свою незастроенную или недостроенную недвижимость, владейте ею'
            ],

        ];
        UserRole::insert($roles);
    }
}
