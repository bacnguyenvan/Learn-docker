<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreaPhotoTableSeeder extends Seeder
{
	use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areaPhotos = $this->dummyData("database/data/area_photos.json");
        foreach ($areaPhotos as $value) {
            \App\Models\AreaPhoto::create((array) $value);
        }
    }
}
