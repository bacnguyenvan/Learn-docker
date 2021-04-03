<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = $this->dummyData("database/data/news.json");
        foreach ($news as $value) {
            \App\Models\News::create((array) $value);
        }
    }
}

