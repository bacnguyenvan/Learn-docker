<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RouteTagTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $route_tag = $this->dummyData("database/data/route_tag.json");
        foreach ($route_tag as $value) {
            \App\Models\RouteTag::create((array) $value);
        }
    }
}
