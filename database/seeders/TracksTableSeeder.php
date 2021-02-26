<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Track;
use Faker\Factory as Faker;

class TracksTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tracks = $this->dummyData("database/data/tracks.json");
        foreach ($tracks as $value) {
            \App\Models\Track::create((array) $value);
        }
    }
}
