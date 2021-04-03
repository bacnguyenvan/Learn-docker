<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrackPoint;
use Faker\Factory as Faker;

class TrackPointsTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        $trackpoints = $this->dummyData("database/data/trackpoints.json");
        foreach ($trackpoints as $value) {
            $point = explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0]);
            $value->latitude = $point[0];
            $value->longitude = $point[1];
            \App\Models\TrackPoint::create((array) $value);
        }
    }
}
