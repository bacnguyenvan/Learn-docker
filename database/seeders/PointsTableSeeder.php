<?php

namespace Database\Seeders;

use Faker\Factory;

use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
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
        $points = $this->dummyData("database/data/points.json");
        foreach ($points as $value) {
            if ($value->id < 69) {
                $point = explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0]);
                $value->latitude = $point[0];
                $value->longitude = $point[1];
            }
            \App\Models\Point::create((array) $value);
        }
    }
}
