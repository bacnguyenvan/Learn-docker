<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IconsSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $icons = $this->dummyData("database/data/icons.json");
        foreach ($icons as $value) {
            \DB::table('icons')->insert((array) $value);
        }
    }
}
