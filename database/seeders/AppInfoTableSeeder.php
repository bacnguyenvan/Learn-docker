<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppInfo;

class AppInfoTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app_info = $this->dummyData("database/data/app_info.json");
        foreach ($app_info as $value) {
            \App\Models\AppInfo::create((array) $value);
        }
    }
}
