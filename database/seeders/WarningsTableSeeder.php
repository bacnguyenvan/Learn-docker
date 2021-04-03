<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class WarningsTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create();

        $warnings = $this->dummyData("database/data/warnings.json");
        foreach ($warnings as $value) {
            $point = explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0]);
            $value->latitude = $point[0];
            $value->longitude = $point[1];
            \App\Models\Warning::create((array) $value);
        }
    }
}
