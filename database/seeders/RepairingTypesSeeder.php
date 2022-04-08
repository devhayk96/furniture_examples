<?php

namespace Database\Seeders;

use App\Models\RepairingType;
use Illuminate\Database\Seeder;

class RepairingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repairingTypes = [
            [
                'title_am' => 'Գերազանց',
                'title_en' => 'Excellent',
                'title_ru' => 'Отлично'
            ],
            [
                'title_am' => 'Լավ',
                'title_en' => 'Good',
                'title_ru' => 'Хорошо'
            ],
            [
                'title_am' => 'Միջին',
                'title_en' => 'Average',
                'title_ru' => 'Средний'
            ],
            [
                'title_am' => 'Վատ',
                'title_en' => 'Bad',
                'title_ru' => 'Плохой'
            ],
            [
                'title_am' => 'Զրոյական',
                'title_en' => 'Deplorable',
                'title_ru' => 'Неудовлетворительный'
            ],
        ];
        foreach ($repairingTypes as $repairingType){
            RepairingType::create($repairingType);
        }
    }
}
