<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\UploadedFile;
use App\Models\Member;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->montbellMember = (object) [
            'username' => 'muratatest2',
            'password' => 'montbell0',
            'type' => 'member'
        ];
    }

    /**
     *
     */
    public function test_member_can_login()
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => $this->montbellMember->username,
            'password' => $this->montbellMember->password,
            'type' => $this->montbellMember->type,
        ]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status_code',
                'message',
                'data' => [
                    'access_token',
                    'token_type'
                ]
            ]);
    }

    /**
     *
     */
    public function test_member_cant_login_wrong_password()
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => $this->montbellMember->username,
            'password' => 'wrong_password',
            'type' => 'member',
        ]);
        $response
            ->assertStatus(350)
            ->assertJsonStructure([
                'status_code',
                'message'
            ]);
    }

    /**
     *
     */
    public function test_member_cant_login_wrong_username()
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => 'wrong_username',
            'password' => $this->montbellMember->password,
            'type' => $this->montbellMember->type,
        ]);
        $response
            ->assertStatus(350)
            ->assertJsonStructure([
                'status_code',
                'message'
            ]);
    }

    //Unit Test
    /**
     *
     */
    public function test_missing_username_field_in_request()
    {
        $response = $this->postJson(route('auth.login'), [
            'password' => 'password',
            'type' => 'member',
        ]);
        $response
            ->assertStatus(422)
            ->assertExactJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'username' => [
                        'The username field is required.'
                    ]
                ]
            ]);
    }

    /**
     *
     */
    public function test_missing_password_field()
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => $this->montbellMember->username,
            'type' => $this->montbellMember->type,
        ]);
        $response
            ->assertStatus(422)
            ->assertExactJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'password' => [
                        'The password field is required.'
                    ]
                ]
            ]);
    }

    /**
     *
     */
    public function test_missing_type_field()
    {
        $response = $this->postJson(route('auth.login'), [
            'username' => $this->montbellMember->username,
            'password' => $this->montbellMember->password
        ]);
        $response
            ->assertStatus(422)
            ->assertExactJson([
                'status_code' => 422,
                'message' => 'Error validated request',
                'errors' => [
                    'type' => [
                        'The type field is required.'
                    ]
                ]
            ]);
    }
}
