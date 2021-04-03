<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LandmarkTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->landmark_id = 1;
    }

    public function test_can_update_landmark()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));
        $data = [
            'name' => 'landmark name',
            'thumbnail' => $file
        ];

        $this->put(route('landmarks.update', $this->landmark_id), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Update landmark success',
                'data' => [
                    'name' => 'landmark name',
                ],
            ]);
    }

    public function test_cant_update_landmark()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 1,
            'thumbnail' => $file
        ];

        $this->put(route('landmarks.update', $this->landmark_id), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name must be a string."]
                ]
            ]);
    }

    public function test_wrong_id_cant_update_landmark()
    {
        $data = [
            'name' => 'landmark name',
        ];
        $id =  's';
        $this->put(route('landmarks.update', $id), $data)
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }

    public function test_can_create_landmark()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 'Landmark name',
            'description' =>  'description',
            'thumbnail' => $file,
            'icon' => 'icon.png',
            'latitude' => 1,
            'longitude' => 1,
            'category' => 'category',
            'address' => 'address',
            'tel' => '0123456',
        ];

        $this->post(route('landmarks.store'), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Insert landmark success',
                'data' => [
                    'name' => 'Landmark name',
                    'description' =>  'description',
                    'icon' => 'icon.png',
                    'latitude' => 1,
                    'longitude' => 1,
                    'category' => 'category',
                    'address' => 'address',
                    'tel' => '0123456',
                ]
            ]);
    }

    public function test_cant_create_landmark()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 123,
            'description' =>  'description',
            'thumbnail' => $file,
            'icon' => 'icon.png',
            'latitude' => 1,
            'longitude' => 1,
            'category' => 'category',
            'address' => 'address',
            'tel' => '0123456',
        ];

        $this->post(route('landmarks.store'), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name must be a string."]
                ]
            ]);
    }

    public function test_can_show_all_landmark()
    {
        $this->get(route('landmarks.index'))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get landmark success',
                'data' => []
            ])->assertJsonCount(42, 'data');
    }

    public function test_can_show_landmark()
    {
        $this->get(route('landmarks.show', $this->landmark_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get landmark success',
                'data' => []
            ]);
    }

    public function test_can_delete_landmark()
    {
        $this->delete(route('landmarks.destroy', $this->landmark_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Delete landmark success',
                'data' => []
            ]);
    }

    public function test_cant_show_landmark()
    {
        $id =  's';
        $this->get(route('landmarks.show', $id))
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }

    public function test_cant_delete_landmark()
    {
        $id = 's';
        $this->get(route('landmarks.destroy', $id))
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }
}
