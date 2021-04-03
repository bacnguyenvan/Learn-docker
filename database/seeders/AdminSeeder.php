<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
        	'name' => 'Admin',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt("admin@1234"),
        	'level' => 1,
            'access_token' => '5|AwPTwA5YyCU1Vw6Mqaeu9gxRgAjC8FvecznSVPBY'
        ]);
        for($i = 1; $i <= 4; $i++){
            \App\Models\Admin::create([
                'name' => 'Admin'.$i,
                'email' => "admin$i@gmail.com",
                'password' => bcrypt("admin@1234"),
                'level' => 1,
                'access_token' => '16|Mb9dpIMg0dzhmw6bffmmihLltTBKbKPCyNYyKRYc'
            ]);
        }
    }
}
