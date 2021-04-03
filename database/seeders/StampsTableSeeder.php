<?php

namespace Database\Seeders;

use Faker\Factory;

use Illuminate\Database\Seeder;

class StampsTableSeeder extends Seeder
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

        $stamps = $this->dummyData("database/data/stamps.json");
        foreach ($stamps as $value) {
            // $point = explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0]);
            // $value->latitude = $point[0];
            // $value->longitude = $point[1];
            \App\Models\Stamp::create((array) $value);
        }
    }
}
