<?php

namespace Database\Seeders;

use App\Models\AdditionalInfo;
use Illuminate\Database\Seeder;

class AdditionalInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $additional_infos = [
            [
                'title_am' => 'Տանիքը փոխված',
                'title_en' => 'Roof changed',
                'title_ru' => 'Крыша изменена'
            ],
            [
                'title_am' => 'Արևկող',
                'title_en' => 'Արևկող',
                'title_ru' => 'Արևկող'
            ],
            [
                'title_am' => 'Կահույք',
                'title_en' => 'Furniture',
                'title_ru' => 'Мебель'
            ],
            [
                'title_am' => 'Ավտոտնակ',
                'title_en' => 'Garage',
                'title_ru' => 'Гараж'
            ],
            [
                'title_am' => 'Գազ',
                'title_en' => 'Gaz',
                'title_ru' => 'Газ'
            ],
            [
                'title_am' => 'Ջեռուցում',
                'title_en' => 'Heating',
                'title_ru' => 'Отопление'
            ],
            [
                'title_am' => 'Օդորակիչ',
                'title_en' => 'Air conditioner',
                'title_ru' => 'Кондиционер'
            ],
            [
                'title_am' => 'Կայանատեղի',
                'title_en' => 'Parking',
                'title_ru' => 'Стоянка'
            ],
            [
                'title_am' => 'Տեխնիկա',
                'title_en' => 'Տեխնիկա',
                'title_ru' => 'Տեխնիկա'
            ],
            [
                'title_am' => 'Խոհանոցի կահույք',
                'title_en' => 'Kitchen furniture',
                'title_ru' => 'Кухонный мебель'
            ],
            [
                'title_am' => 'Ներկառուցված պահարաններ',
                'title_en' => 'Built-in wardrobes',
                'title_ru' => 'Встроенные шкафы'
            ],
            [
                'title_am' => 'Խորդանոց',
                'title_en' => 'Storeroom',
                'title_ru' => 'Кладовая'
            ],

        ];
        foreach ($additional_infos as $additional_info){

            AdditionalInfo::create($additional_info);
        }

    }
}
