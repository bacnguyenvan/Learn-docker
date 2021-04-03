<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AreasTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $areas = $this->dummyData("database/data/areas.json");
        foreach ($areas as $value) {
            $arr = (array) $value;
            $area = \App\Models\Area::create(Arr::except($arr, 'prefecture_id'));

            $prefecture_ids = explode(',', $arr['prefecture_id']);
            $prefecture_data = array_map(function ($id) {
                return ['prefecture_id' => $id];
            }, $prefecture_ids);
            $area->area_prefectures()->createMany($prefecture_data);
        }
    }
}
