<?php

namespace Database\Seeders;

use App\Models\BuildingFloor;
use Illuminate\Database\Seeder;

class BuildingFloorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buildingFloors = [
            [
                'title_am' => 'նկուղ',
                'title_en' => 'basement',
                'title_ru' => 'подвал'
            ],
            [
                'title_am' => 'կիսաՆկուղ',
                'title_en' => 'basement',
                'title_ru' => 'подвал'
            ],
            [
                'title_am' => 'ձեղնահարկ',
                'title_en' => 'attic',
                'title_ru' => 'чердак'
            ],
        ];

        foreach (range(1,25) as $n){
            $buildingFloors [] = [
                'title_am' => $n,
                'title_en' => $n,
                'title_ru' => $n
            ];
        }
        foreach ($buildingFloors as $buildingFloor){
            BuildingFloor::create($buildingFloor);
        }
    }
}
