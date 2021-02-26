<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class LandmarksTableSeeder extends Seeder
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

        $landmarks = $this->dummyData("database/data/landmarks.json");
       
        foreach ($landmarks as $value) {
            // $point = explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0]);
            // $value->latitude = $point[0];
            // $value->longitude = $point[1];
            \App\Models\Landmark::create((array) $value);
        }
    }
}
