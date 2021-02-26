<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = $this->dummyData("database/data/regions.json");
        foreach ($regions as $value) {
            \App\Models\Region::create((array) $value);
        }
    }
}
