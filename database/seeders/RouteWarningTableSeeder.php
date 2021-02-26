<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class RouteWarningTableSeeder extends Seeder
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

        $route_warning = $this->dummyData("database/data/route_warning.json");
        foreach ($route_warning as $value) {
            \App\Models\RouteWarning::create((array) $value);
        }
    }
}
