<?php

namespace Database\Seeders;

use App\Models\MemberNotification;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            $mem_noti = MemberNotification::factory()->create([
                'notification_id' => $i
            ]);

            Notification::factory()
                ->state(function () use ($i, $mem_noti) {
                    return [
                        'id' => $i,
                        'title' => "Notification $i",
                        'member_extract' => "member_id:{$mem_noti->member_id}",
                    ];
                })
                ->create();
        }
    }
}
