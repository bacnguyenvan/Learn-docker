<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use Faker\Factory as Faker;

class MembersTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = $this->dummyData("database/data/members.json");
        foreach ($members as $value) {
            \App\Models\Member::create((array) $value);
        }
    }
}
