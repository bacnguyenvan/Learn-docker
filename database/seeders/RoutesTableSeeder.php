<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoutesTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = $this->dummyData("database/data/routes.json");
        foreach ($routes as $value) {
            \App\Models\Route::create((array) $value);
        }
    }
}
