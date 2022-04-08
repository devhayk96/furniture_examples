<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('districts')->truncate();
        Schema::enableForeignKeyConstraints();

        $districts = [

            /* Yerevan district communities start */
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Աջափնյակ',
                'title_ru' => 'Ачапняк',
                'title_en' => 'Ajapnyak',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Արաբկիր',
                'title_ru' => 'Арабкир',
                'title_en' => 'Arabkir',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Ավան',
                'title_ru' => 'Аван',
                'title_en' => 'Avan',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Դավթաշեն',
                'title_ru' => 'Давташен',
                'title_en' => 'Davtashen',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Վահագնի թաղամաս',
                'title_ru' => 'Ваагни район',
                'title_en' => 'Vahagni district',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Քանաքեռ-Զեյթուն',
                'title_ru' => 'Канакер-Зейтун',
                'title_en' => 'Kanaker-Zeytun',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Էրեբունի',
                'title_ru' => 'Эребуни',
                'title_en' => 'Erebuni',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Կենտրոն',
                'title_ru' => 'Центр',
                'title_en' => 'Centre',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Մալաթիա-Սեբաստիա',
                'title_ru' => 'Малатия-Себастия',
                'title_en' => 'Malatia-Sebastia',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Նորք-Մարաշ',
                'title_ru' => 'Норк-Мараш',
                'title_en' => 'Nork-Marash',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Նոր Նորք',
                'title_ru' => 'Нор Норк',
                'title_en' => 'Nor Nork',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Նուբարաշեն',
                'title_ru' => 'Нубарашен',
                'title_en' => 'Nubarashen',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Շենգավիթ',
                'title_ru' => 'Шенгавит',
                'title_en' => 'Shengavit',
            ],
            [
                'region_id' => Region::Yerevan_ID,
                'title_am' => 'Փոքր Կենտրոն',
                'title_ru' => 'Малый центр',
                'title_en' => 'Small centre',
            ],
            /* Yerevan district communities end */

        ];

        District::insert($districts);
    }
}
