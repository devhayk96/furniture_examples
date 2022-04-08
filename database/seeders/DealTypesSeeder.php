<?php

namespace Database\Seeders;

use App\Models\DealType;
use Illuminate\Database\Seeder;

class DealTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dealTypes = [
            [
                'title_am' => 'Վաճառք',
                'title_en' => 'FOR SALE',
                'title_ru' => 'Продажа'
            ],
            [
                'title_am' => 'Վարձակալություն',
                'title_en' => 'FOR RENT',
                'title_ru' => 'Аренда'
            ],
            [
                'title_am' => 'Օրավարձ',
                'title_en' => 'Short Term',
                'title_ru' => 'Посуточно'
            ],
        ];
        foreach ($dealTypes as $dealType){
            DealType::create($dealType);
        }
    }
}
