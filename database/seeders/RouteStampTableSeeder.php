<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RouteStampTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $route_stamp = $this->dummyData("database/data/route_stamp.json");
        foreach ($route_stamp as $value) {
            \App\Models\RouteStamp::create((array) $value);
        }
    }
}
