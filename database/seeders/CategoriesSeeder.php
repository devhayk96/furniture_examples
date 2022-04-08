<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title_am' => 'Բնակարան',
                'title_en' => 'Apartment',
                'title_ru' => 'Квартира'
            ],
            [
                'title_am' => 'Առանձնատուն',
                'title_en' => 'House',
                'title_ru' => 'Особняк'
            ],
            [
                'title_am' => 'Կոմերցիոն տարածք',
                'title_en' => 'Commercial area',
                'title_ru' => 'Коммерческая площадь',
            ],
            [
                'title_am' => 'Հողատարածք',
                'title_en' => 'Land',
                'title_ru' => 'Земельной участок'
            ],
            [
                'parent_id' => 3,
                'title_am' => 'Առևտրային',
                'title_en' => 'Commercial',
                'title_ru' => 'Коммерческая'
            ],
            [
                'parent_id' => 3,
                'title_am' => 'Գրասենյակային',
                'title_en' => 'Office',
                'title_ru' => 'Офис'
            ],
            [
                'parent_id' => 3,
                'title_am' => 'Արտադրամաս',
                'title_en' => 'Manufacturing',
                'title_ru' => 'Производство'
            ],
            [
                'parent_id' => 3,
                'title_am' => 'Պահեստային',
                'title_en' => 'Warehouse',
                'title_ru' => 'Склад'
            ],
            [
                'parent_id' => 3,
                'title_am' => 'Ունիվերսալ',
                'title_en' => 'All-purpose',
                'title_ru' => 'Универсальный'
            ],
            [
                'parent_id' => 4,
                'title_am' => 'Բնակելի',
                'title_en' => 'Settlement',
                'title_ru' => 'Для поселений'
            ],
            [
                'parent_id' => 4,
                'title_am' => 'Հասարակական',
                'title_en' => 'Social',
                'title_ru' => 'Социальное'
            ],
            [
                'parent_id' => 4,
                'title_am' => 'Գյուղատնտեսական',
                'title_en' => 'Agricultural',
                'title_ru' => 'Сельскохозяйственная'
            ],
            [
                'parent_id' => 4,
                'title_am' => 'Այլ',
                'title_en' => 'Other',
                'title_ru' => 'Другой'
            ],
        ];
        foreach ($categories as $category){
            Category::create($category);
        }


    }
}
