<?php

namespace Database\Seeders;

use App\Models\BuildingType;
use Illuminate\Database\Seeder;

class BuildingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buildingTypes = [
            [
                'title_am' => 'Քարե',
                'title_en' => 'Stone',
                'title_ru' => 'Каменное'
            ],
            [
                'title_am' => 'Պանելային',
                'title_en' => 'Panel',
                'title_ru' => 'Панельное'
            ],
            [
                'title_am' => 'Նորակառույց',
                'title_en' => 'New Construction',
                'title_ru' => 'Новостройка'
            ],
            [
                'title_am' => 'Այլ',
                'title_en' => 'Other',
                'title_ru' => 'Другое'
            ],
        ];

        foreach ($buildingTypes as $buildingType){
            BuildingType::create($buildingType);
        }

    }
}
