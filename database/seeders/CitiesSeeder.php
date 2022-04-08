<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cities')->truncate();
        Schema::enableForeignKeyConstraints();

        $cities = [
            /* Aragatsotn cities start */
            [
                'region_id' => Region::Aragatsotn_ID,
                'title_am' => 'Աշտարակ',
                'title_ru' => 'Аштарак',
                'title_en' => 'Ashtarak',
            ],
            [
                'region_id' => Region::Aragatsotn_ID,
                'title_am' => 'Ապարան',
                'title_ru' => 'Апаран',
                'title_en' => 'Aparan',
            ],
            [
                'region_id' => Region::Aragatsotn_ID,
                'title_am' => 'Թալին',
                'title_ru' => 'Талин',
                'title_en' => 'Talin',
            ],
            /* Aragatsotn cities end */


            /* Ararat cities start */
            [
                'region_id' => Region::Ararat_ID,
                'title_am' => 'Արտաշատ',
                'title_ru' => 'Арташат',
                'title_en' => 'Artashat',
            ],
            [
                'region_id' => Region::Ararat_ID,
                'title_am' => 'Արարատ',
                'title_ru' => 'Арарат',
                'title_en' => 'Ararat',
            ],
            [
                'region_id' => Region::Ararat_ID,
                'title_am' => 'Մասիս',
                'title_ru' => 'Масис',
                'title_en' => 'Masis',
            ],
            [
                'region_id' => Region::Ararat_ID,
                'title_am' => 'Վեդի',
                'title_ru' => 'Веди',
                'title_en' => 'Vedi',
            ],
            /* Ararat cities end */


            /* Armavir cities start */
            [
                'region_id' => Region::Armavir_ID,
                'title_am' => 'Արմավիր',
                'title_ru' => 'Армавир',
                'title_en' => 'Armavir',
            ],
            [
                'region_id' => Region::Armavir_ID,
                'title_am' => 'Վաղարշապատ',
                'title_ru' => 'Вахаршапат',
                'title_en' => 'Vagharshapat',
            ],
            [
                'region_id' => Region::Armavir_ID,
                'title_am' => 'Մեծամոր',
                'title_ru' => 'Мецамор',
                'title_en' => 'Metsamor',
            ],
            /* Armavir cities end */

            /* Gegharkunik cities start */
            [
                'region_id' => Region::Gegharkunik_ID,
                'title_am' => 'Գավառ',
                'title_ru' => 'Гавар',
                'title_en' => 'Gavar',
            ],
            [
                'region_id' => Region::Gegharkunik_ID,
                'title_am' => 'Ճամբարակ',
                'title_ru' => 'Чамбарак',
                'title_en' => 'Chambarak',
            ],
            [
                'region_id' => Region::Gegharkunik_ID,
                'title_am' => 'Մարտունի',
                'title_ru' => 'Мартуни',
                'title_en' => 'Martuni',
            ],
            [
                'region_id' => Region::Gegharkunik_ID,
                'title_am' => 'Սևան',
                'title_ru' => 'Севан',
                'title_en' => 'Sevan',
            ],
            [
                'region_id' => Region::Gegharkunik_ID,
                'title_am' => 'Վարդենիս',
                'title_ru' => 'Варденис',
                'title_en' => 'Vardenis',
            ],
            /* Gegharkunik cities end */

            /* Lori cities start */
            [
                'region_id' => Region::Lori_ID,
                'title_am' => 'Ալավերդի',
                'title_ru' => 'Алаверди',
                'title_en' => 'Alaverdi',
            ],
            [
                'region_id' => Region::Lori_ID,
                'title_am' => 'Ախթալա',
                'title_ru' => 'Ахтала',
                'title_en' => 'Akhtala',
            ],
            [
                'region_id' => Region::Lori_ID,
                'title_am' => 'Թումանյան',
                'title_ru' => 'Туманян',
                'title_en' => 'Tumanyan',
            ],
            [
                'region_id' => Region::Lori_ID,
                'title_am' => 'Շամլուղ',
                'title_ru' => 'Шамлух',
                'title_en' => 'Shamlugh',
            ],
            [
                'region_id' => Region::Lori_ID,
                'title_am' => 'Սպիտակ',
                'title_ru' => 'Спитак',
                'title_en' => 'Spitak',
            ],
            [
                'region_id' => Region::Lori_ID,
                'title_am' => 'Ստեփանավան',
                'title_ru' => 'Степанаван',
                'title_en' => 'Stepanavan',
            ],
            [
                'region_id' => Region::Lori_ID,
                'title_am' => 'Վանաձոր',
                'title_ru' => 'Ванадзор',
                'title_en' => 'Vanadzor',
            ],
            [
                'region_id' => Region::Lori_ID,
                'title_am' => 'Տաշիր',
                'title_ru' => 'Ташир',
                'title_en' => 'Tashir',
            ],
            /* Lori cities end */


            /* Kotayk cities start */
            [
                'region_id' => Region::Kotayk_ID,
                'title_am' => 'Հրազդան',
                'title_ru' => 'Раздан',
                'title_en' => 'Hrazdan',
            ],
            [
                'region_id' => Region::Kotayk_ID,
                'title_am' => 'Աբովյան',
                'title_ru' => 'Абовян',
                'title_en' => 'Abovyan',
            ],
            [
                'region_id' => Region::Kotayk_ID,
                'title_am' => 'Բյուրեղավան',
                'title_ru' => 'Бюрехаван',
                'title_en' => 'Byureghavan',
            ],
            [
                'region_id' => Region::Kotayk_ID,
                'title_am' => 'Եղվարդ',
                'title_ru' => 'Ехвард',
                'title_en' => 'Yeghvard',
            ],
            [
                'region_id' => Region::Kotayk_ID,
                'title_am' => 'Ծաղկաձոր',
                'title_ru' => 'Цахкадзор',
                'title_en' => 'Tsaghkadzor',
            ],
            [
                'region_id' => Region::Kotayk_ID,
                'title_am' => 'Նոր Հաճն',
                'title_ru' => 'Нор Ачн',
                'title_en' => 'Nor Hachn',
            ],
            [
                'region_id' => Region::Kotayk_ID,
                'title_am' => 'Չարենցավան',
                'title_ru' => 'Чаренцаван',
                'title_en' => 'Charentsavan',
            ],
            /* Kotayk cities end */


            /* Shirak cities start */
            [
                'region_id' => Region::Shirak_ID,
                'title_am' => 'Գյումրի',
                'title_ru' => 'Гюмри',
                'title_en' => "Gyumri",
            ],
            [
                'region_id' => Region::Shirak_ID,
                'title_am' => 'Արթիկ',
                'title_ru' => 'Артик',
                'title_en' => "Artik",
            ],
            [
                'region_id' => Region::Shirak_ID,
                'title_am' => 'Մարալիկ',
                'title_ru' => 'Маралик',
                'title_en' => "Maralik",
            ],
            /* Shirak cities end */


            /* Syunik cities start */
            [
                'region_id' => Region::Syunik_ID,
                'title_am' => "Կապան",
                'title_ru' => "Капан",
                'title_en' => "Kapan",
            ],
            [
                'region_id' => Region::Syunik_ID,
                'title_am' => "ք. Ագարակ",
                'title_ru' => "г. Агарак",
                'title_en' => "Agarak",
            ],
            [
                'region_id' => Region::Syunik_ID,
                'title_am' => "Գորիս",
                'title_ru' => "Горис",
                'title_en' => "Goris",
            ],
            [
                'region_id' => Region::Syunik_ID,
                'title_am' => "Դաստակերտ",
                'title_ru' => "Дастакерт",
                'title_en' => "Dastakert",
            ],
            [
                'region_id' => Region::Syunik_ID,
                'title_am' => "Մեղրի",
                'title_ru' => "Мехри",
                'title_en' => "Meghri",
            ],
            [
                'region_id' => Region::Syunik_ID,
                'title_am' => "Սիսիան",
                'title_ru' => "Сисиан",
                'title_en' => "Sisian",
            ],
            [
                'region_id' => Region::Syunik_ID,
                'title_am' => "Քաջարան",
                'title_ru' => "Каджаран",
                'title_en' => "Kajaran",
            ],
            /* Syunik cities end */


            /* Vayots Dzor cities start */
            [
                'region_id' => Region::Vayots_Dzor_ID,
                'title_am' => 'Եղեգնաձոր',
                'title_ru' => 'Ехегнадзор',
                'title_en' => "Yeghegnadzor",
            ],
            [
                'region_id' => Region::Vayots_Dzor_ID,
                'title_am' => 'Ջերմուկ',
                'title_ru' => 'Джермук',
                'title_en' => "Jermuk",
            ],
            [
                'region_id' => Region::Vayots_Dzor_ID,
                'title_am' => 'Վայք',
                'title_ru' => 'Вайк',
                'title_en' => "Vayk",
            ],
            /* Vayots Dzor cities end */


            /* Tavush cities start */
            [
                'region_id' => Region::Tavush_ID,
                'title_am' => 'Իջևան',
                'title_ru' => 'Иджеван',
                'title_en' => "Ijevan",
            ],
            [
                'region_id' => Region::Tavush_ID,
                'title_am' => 'Այրում',
                'title_ru' => 'Айрум',
                'title_en' => "Ayrum",
            ],
            [
                'region_id' => Region::Tavush_ID,
                'title_am' => 'Բերդ',
                'title_ru' => 'Берд',
                'title_en' => "Berd",
            ],
            [
                'region_id' => Region::Tavush_ID,
                'title_am' => 'Դիլիջան',
                'title_ru' => 'Дилиджан',
                'title_en' => "Dilijan",
            ],
            [
                'region_id' => Region::Tavush_ID,
                'title_am' => 'Նոյեմբերյան',
                'title_ru' => 'Ноемберян',
                'title_en' => "Noyemberyan",
            ],
            /* Tavush cities end */

        ];

        City::insert($cities);
    }
}
