<?php

namespace Tests\Feature;

use Tests\TestCase;

class ActivityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->id = 1;
    }

    public function test_can_update_activity()
    {
        $data = [
            'name' => "edit_name",
        ];

        $this->put(route('activities.update', $this->id), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Update activity success',
                'data' => [
                    'name' => "edit_name",
                ],
            ]);
    }

    public function test_cant_update_activity()
    {
        $data = [
            'name' => 123,
        ];

        $this->put(route('activities.update', $this->id), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name must be a string."]
                ]
            ]);
    }

    public function test_can_create_activity()
    {
        $data = [
            'name' => "new_activity",
        ];

        $this->post(route('activities.store'), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Insert activity success',
                'data' => []
            ]);
    }

    public function test_cant_create_activity()
    {
        $data = [
            'name' => null,
        ];

        $this->post(route('activities.store'), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name field is required."]
                ]
            ]);
    }

    public function test_can_show_activity()
    {
        $this->get(route('activities.show', $this->id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get activity success',
                'data' => []
            ]);
    }

    public function test_can_delete_activity()
    {
        $this->delete(route('activities.destroy', $this->id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Delete activity success',
                'data' => []
            ]);
    }

    public function test_can_show_all_activity()
    {
        $this->get(route('activities.index'))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get activity success',
                'data' => []
            ])->assertJsonCount(5, 'data');
    }
}
