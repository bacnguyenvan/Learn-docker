<?php

namespace Tests\Feature;

use Tests\TestCase;

class TagTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->tag_id = 1;
    }

    public function test_can_update_tag()
    {
        $data = [
            'name' => 'Tag name',
        ];

        $this->put(route('tags.update', $this->tag_id), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Update tag success',
                'data' => [
                    'name' => 'Tag name',
                ],
            ]);
    }

    public function test_cant_update_tag()
    {
        $data = [
            'name' => null,
        ];

        $this->put(route('tags.update', $this->tag_id), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name field is required."]
                ]
            ]);
    }

    public function test_wrong_id_cant_update_tag()
    {
        $data = [
            'name' => 'Tag name',
        ];
        $id = 's';
        $this->put(route('tags.update', $id), $data)
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }

    public function test_can_create_tag()
    {
        $data = [
            'name' => 'Tag name',
        ];

        $this->post(route('tags.store'), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Insert tag success',
                'data' => [
                    'name' => 'Tag name',
                ]
            ]);
    }

    public function test_cant_create_tag()
    {
        $data = [
            'name' => null,
        ];

        $this->post(route('tags.store'), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name field is required."]
                ]
            ]);
    }

    public function test_can_show_all_tag()
    {
        $this->get(route('tags.index'))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get tag success',
                'data' => []
            ])->assertJsonCount(15, 'data');
    }

    public function test_can_show_tag()
    {
        $this->get(route('tags.show', $this->tag_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get tag success',
                'data' => []
            ]);
    }

    public function test_can_delete_tag()
    {
        $this->delete(route('tags.destroy', $this->tag_id))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Delete tag success',
                'data' => []
            ]);
    }

    public function test_cant_show_tag()
    {
        $id = 's';
        $this->get(route('tags.show', $id))
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }

    public function test_cant_delete_tag()
    {
        $id = 's';
        $this->get(route('tags.destroy', $id))
            ->assertStatus(404)
            ->assertJson([
                'status_code' => 404,
                'message' => 'Model not found',
            ]);
    }
}
