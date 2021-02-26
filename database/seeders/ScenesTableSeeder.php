<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScenesTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scenes = $this->dummyData("database/data/scenes.json");
        foreach ($scenes as $value) {
            \App\Models\Scene::create((array) $value);
        }
    }
}
