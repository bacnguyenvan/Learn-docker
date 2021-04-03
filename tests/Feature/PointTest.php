<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class PointTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->point_id = 1;
    }

    public function test_can_update_point()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 'Point name',
            'thumbnail' => $file
        ];

        $this->put(route('points.update', $this->point_id), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Update point success',
                'data' => [
                    'name' => 'Point name',
                ],
            ]);
    }

    public function test_cant_update_point()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'name' => 123,
            'thumbnail' => $file

        ];

        $this->put(route('points.update', $this->point_id), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name must be a string."]
                ]
            ]);
    }

    public function test_wrong_id_cant_update_point()
    {
        $data = [
            'name' => 'Point name',
        ];
        $id = 's';
        $this->put(route('points.update', $id), $data)
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }

    public function test_can_create_point()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'area_id' => 1,
            'support_id' => 1,
            'name' => 'Point name',
            'number' => 1,
            'title' =>  'Title',
            'description' =>  'description',
            'category' => 'category',
            'address' => 'address',
            'tel' => 'tel',
            'latitude' => 1,
            'longitude' => 1,
            'elevation' => 1,
            'thumbnail' => $file,
            'distance_to_next' => 1,
            'time_to_next' => 1,
            'site_url' => 'site_url',
            'montbell_friend_shop' => 'montbell_friend_shop',
            'other' => 'other',
        ];

        $this->post(route('points.store'), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Insert point success',
                'data' => [
                    'area_id' => 1,
                    'support_id' => 1,
                    'name' => 'Point name',
                    'number' => 1,
                    'title' =>  'Title',
                    'description' =>  'description',
                    'category' => 'category',
                    'address' => 'address',
                    'tel' => 'tel',
                    'latitude' => 1,
                    'longitude' => 1,
                    'elevation' => 1,
                    'distance_to_next' => 1,
                    'time_to_next' => 1,
                    'site_url' => 'site_url',
                    'montbell_friend_shop' => 'montbell_friend_shop',
                    'other' => 'other',
                ]
            ]);
    }

    public function test_cant_create_point()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));

        $data = [
            'area_id' => 1,
            'support_id' => 1,
            'name' => 123,
            'number' => 1,
            'title' =>  'Title',
            'description' =>  'description',
            'category' => 'category',
            'address' => 'address',
            'tel' => 'tel',
            'latitude' => 1,
            'longitude' => 1,
            'elevation' => 1,
            'thumbnail' => $file,
            'distance_to_next' => 1,
            'time_to_next' => 1,
            'site_url' => 'site_url',
            'montbell_friend_shop' => 'montbell_friend_shop',
            'other' => 'other',
        ];

        $this->post(route('points.store'), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name must be a string."]
                ]
            ]);
    }

    public function test_can_show_all_point()
    {
        $this->get(route('points.index'))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get point success',
                'data' => []
            ])->assertJsonCount(66, 'data');
    }

    public function test_can_show_point()
    {
        $this->get(route('points.show', $this->point_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get point success',
                'data' => []
            ]);
    }

    public function test_can_delete_point()
    {
        $this->delete(route('points.destroy', $this->point_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Delete point success',
                'data' => []
            ]);
    }

    public function test_cant_show_point()
    {
        $id = 's';
        $this->get(route('points.show', $id))
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }

    public function test_cant_delete_point()
    {
        $id = 's';
        $this->get(route('points.destroy', $id))
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }
}
