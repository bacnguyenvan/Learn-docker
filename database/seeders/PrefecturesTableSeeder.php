<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prefecture;
use Faker\Factory as Faker;

class PrefecturesTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prefectures = $this->dummyData("database/data/prefectures.json");
        foreach ($prefectures as $value) {
            \App\Models\Prefecture::create((array) $value);
        }
    }
}
