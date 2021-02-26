<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MemberNotificationTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member_notification = $this->dummyData("database/data/member_notification.json");
        foreach ($member_notification as $value) {
            \App\Models\MemberNotification::create((array) $value);
        }
    }
}
