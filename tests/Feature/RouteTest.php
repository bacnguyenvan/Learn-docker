<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->route_id = 1;
        $this->activity_id = 1;
        $this->area_id = 1;
        $this->tag_id = 1;
        $this->scene_id = '1,4';
        $this->position = '31.421721,130.111679';
    }

    public function test_can_show_route()
    {
        $this->get(route('routes.show', $this->route_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get route success',
                'data' => [],
            ]);
    }

    public function test_can_filter_route()
    {
        $this->get(route(
            'routes.filters',
            [
                'activities' => $this->activity_id,
                'tags' => $this->tag_id,
                'area' => $this->area_id,
                'scenes' => $this->scene_id,
                'position' => $this->position
            ]
        ))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get list routes success',
                'data' => [],
            ])
            ->assertJsonCount(1, 'data');
    }
}
