<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationTypeTableSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notification_type = $this->dummyData("database/data/notification_type.json");
        foreach ($notification_type as $value) {
            \App\Models\NotificationType::create((array) $value);
        }
    }
}
