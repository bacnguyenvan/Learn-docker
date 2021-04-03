<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RouteLandmarkTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $route_landmark = $this->dummyData("database/data/route_landmark.json");
        foreach ($route_landmark as $value) {
            \App\Models\RouteLandmark::create((array) $value);
        }
    }
}
