<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RouteActivityTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $route_activity = $this->dummyData("database/data/route_activity.json");
        foreach ($route_activity as $value) {
            \App\Models\RouteActivity::create((array) $value);
        }
    }
}
