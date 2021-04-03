<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = $this->dummyData("database/data/tags.json");
        foreach ($tags as $value) {
            \App\Models\Tag::create((array) $value);
        }
    }
}
