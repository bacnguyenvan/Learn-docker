<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MemberStampTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $memberStamp = $this->dummyData("database/data/member_stamp.json");
        foreach ($memberStamp as $value) {
            \App\Models\MemberStamp::create((array) $value);
        }
    }
}
