<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitiesTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = $this->dummyData("database/data/activities.json");
        foreach ($activities as $value) {
            \App\Models\Activity::create((array) $value);
        }
    }
}
