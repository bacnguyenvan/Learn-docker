<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RouteSceneTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $route_scene = $this->dummyData("database/data/route_scene.json");
        foreach ($route_scene as $value) {
            \App\Models\RouteScene::create((array) $value);
        }
    }
}
