<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoutePointTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $route_point = $this->dummyData("database/data/route_point.json");
        foreach ($route_point as $value) {
            \App\Models\RoutePoint::create((array) $value);
        }
    }
}
