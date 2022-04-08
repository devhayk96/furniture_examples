<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('regions')->truncate();
        Schema::enableForeignKeyConstraints();

        $regions = [
            [
                'id' => Region::Aragatsotn_ID,
                'title_am' => 'Արագածոտն',
                'title_ru' => 'Арагацотн',
                'title_en' => 'Aragatsotn',
            ],
            [
                'id' => Region::Ararat_ID,
                'title_am' => 'Արարատ',
                'title_ru' => 'Арарат',
                'title_en' => 'Ararat',
            ],
            [
                'id' => Region::Armavir_ID,
                'title_am' => 'Արմավիր',
                'title_ru' => 'Армавир',
                'title_en' => 'Armavir',
            ],
            [
                'id' => Region::Gegharkunik_ID,
                'title_am' => 'Գեղարքունիք',
                'title_ru' => 'Гехаркуник',
                'title_en' => 'Gegharkunik',
            ],
            [
                'id' => Region::Lori_ID,
                'title_am' => 'Լոռի',
                'title_ru' => 'Лори',
                'title_en' => 'Lori',
            ],
            [
                'id' => Region::Kotayk_ID,
                'title_am' => 'Կոտայք',
                'title_ru' => 'Котайк',
                'title_en' => 'Kotayk',
            ],
            [
                'id' => Region::Shirak_ID,
                'title_am' => 'Շիրակ',
                'title_ru' => 'Ширак',
                'title_en' => 'Shirak',
            ],
            [
                'id' => Region::Syunik_ID,
                'title_am' => 'Սյունիք',
                'title_ru' => 'Сюник',
                'title_en' => 'Syunik',
            ],
            [
                'id' => Region::Vayots_Dzor_ID,
                'title_am' => 'Վայոց ձոր',
                'title_ru' => 'Вайоц дзор',
                'title_en' => 'Vayots Dzor',
            ],
            [
                'id' => Region::Tavush_ID,
                'title_am' => 'Տավուշ',
                'title_ru' => 'Тавуш',
                'title_en' => 'Tavush',
            ],
            [
                'id' => Region::Yerevan_ID,
                'title_am' => 'Երևան',
                'title_ru' => 'Ереван',
                'title_en' => 'Yerevan',
            ]
        ];

        Region::insert($regions);
    }
}
