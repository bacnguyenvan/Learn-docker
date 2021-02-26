<?php

namespace Tests\Feature;

use Tests\TestCase;

class AreaTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->prefecture_id = 1;
    }

    public function test_can_show_all_area()
    {
        $this->get(route('areas.index'))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get areas list success',
                'data' => [],
            ])->assertJsonCount(17, 'data');
    }

    public function test_can_show_area_by_prefecture()
    {
        $this->get(route('areas.show', $this->prefecture_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get area success',
                'data' => [],
            ])->assertJsonCount(2, 'data');
    }
}
