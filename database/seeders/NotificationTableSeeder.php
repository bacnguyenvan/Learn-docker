<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notifications = $this->dummyData("database/data/notifications.json");
        foreach ($notifications as $value) {
            $value->release_time = now();
            \App\Models\Notification::create((array) $value);
        }
    }
}
