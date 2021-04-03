<?php

namespace Database\Seeders;

use App\Models\MemberDevice;
use App\Models\UserDevice;
use Illuminate\Database\Seeder;

class UserDeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDevice::factory()
            ->count(20)
            ->has(MemberDevice::factory(), 'member_devices')
            ->create();
    }
}
