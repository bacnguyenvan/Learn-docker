<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MemberNewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = [];
        for ($i = 1; $i < 100; $i++) {
            $member_id = random_int(1, 8);
            $news_id = random_int(1, 99);
            if (empty($m[$member_id])) {
                $m[$member_id] = [];
            }
            if (isset($m[$member_id][$news_id])) {
                continue;
            }
            $m[$member_id][$news_id] = 1;

            \App\Models\MemberNews::create([
                'id' => $i,
                'member_id' => $member_id,
                'news_id' => $news_id,
            ]);
        }
    }
}
