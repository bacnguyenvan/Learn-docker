<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
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
            \App\Models\Area::create((array) $value);
        }
    }
}
