<?php

namespace Tests\Feature;

use App\Models\AppInfo;
use Tests\TestCase;

class AppInfoTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->id = 1;
    }

    public function test_can_update_app_info()
    {
        $data = [
            'name' => 'App Info',
            'version' => '1.0.0',

        ];

        $this->put(route('appinfo.store'), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Update app success',
                'data' => [
                    'name' => $data['name'],
                    'version' => $data['version']
                ],
            ]);
    }

    public function test_cant_update_app_info()
    {
        $data = [
            'name' => null,
            'version' => '1.0.0',
        ];

        $this->put(route('appinfo.store'), $data)
            ->assertStatus(422)
            ->assertJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'name' => ["The name field is required."]
                ]
            ]);
    }

    public function test_can_show_app_info()
    {
        $this->get(route('appinfo.show'))
            ->assertStatus(200);
    }
}
