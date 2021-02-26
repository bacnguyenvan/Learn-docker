<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class StampTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->stamp_id = 1;
    }

    public function test_can_update_stamp()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 'Stamp name',
            'description' =>  'description',
            'thumbnail' => $file,
            'latitude' => 1,
            'longitude' => 1,
            'type' => 'type',
        ];

        $this->put(route('stamps.update', $this->stamp_id), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Update stamp success',
                'data' => [
                    'name' => 'Stamp name',
                    'description' =>  'description',
                    'latitude' => 1,
                    'longitude' => 1,
                    'type' => 'type',
                ],
            ]);
    }

    public function test_cant_update_stamp()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 1,
            'description' =>  'description',
            'thumbnail' => $file,
            'latitude' => 1,
            'longitude' => 1,
            'type' => 'type',
        ];

        $this->put(route('stamps.update', $this->stamp_id), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name must be a string."]
                ]
            ]);
    }

    public function test_wrong_id_cant_update_stamp()
    {
        $data = [
            'name' => 'Stamp name',
        ];
        $id = 's';
        $this->put(route('stamps.update', $id), $data)
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }

    public function test_can_create_stamp()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 'Stamp name',
            'description' =>  'description',
            'thumbnail' => $file,
            'latitude' => 1,
            'longitude' => 1,
            'type' => 'type',
        ];

        $this->post(route('stamps.store'), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Insert stamp success',
                'data' => [
                    'name' => 'Stamp name',
                    'description' =>  'description',
                    'latitude' => 1,
                    'longitude' => 1,
                    'type' => 'type',
                ]
            ]);
    }

    public function test_cant_create_stamp()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 1,
            'description' =>  'description',
            'thumbnail' => $file,
            'latitude' => 1,
            'longitude' => 1,
            'type' => 'type',
        ];

        $this->post(route('stamps.store'), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name must be a string."]
                ]
            ]);
    }

    public function test_can_show_all_stamp()
    {
        $this->get(route('stamps.index'))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get stamp success',
                'data' => []
            ])->assertJsonCount(8, 'data');
    }

    public function test_can_show_stamp()
    {
        $this->get(route('stamps.show', $this->stamp_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get stamp success',
                'data' => []
            ]);
    }

    public function test_can_delete_stamp()
    {
        $this->delete(route('stamps.destroy', $this->stamp_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Delete stamp success',
                'data' => []
            ]);
    }

    public function test_cant_show_stamp()
    {
        $id = 's';
        $this->get(route('stamps.show', $id))
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }

    public function test_cant_delete_stamp()
    {
        $id = 's';
        $this->get(route('stamps.destroy', $id))
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }
}
