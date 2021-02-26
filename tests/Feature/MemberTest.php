<?php

namespace Tests\Feature;

use Tests\TestCase;

class MemberTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $res = $this->postJson(route('auth.login'), [
            'username' => 'muratatest2',
            'password' => 'montbell0',
            'type' => 'member',
        ]);
        $this->accessToken = $res['data']['access_token'];
        $this->memberId = $res['data']['member_id'];
        $this->notification_id = 1;
    }

    public function test_can_get_member_profile()
    {
        $response = $this->withHeaders(['authorization' => $this->accessToken])->get(route('members.show', $this->memberId));
        $response
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get profile success',
                'data' => []
            ]);
    }

    public function test_cant_get_member_profile()
    {
        $this->get(route('members.show', $this->memberId))
            ->assertStatus(401)
            ->assertJson([
                'status_code' => 401,
                'message' => 'MontBell Token Not Valid'
            ]);
    }

    public function test_cant_get_stamp_list()
    {
        $this->get(route('members.stamps', $this->memberId))
            ->assertStatus(401)
            ->assertJson([
                'status_code' => 401,
                'message' => 'MontBell Token Not Valid'
            ]);
    }

    public function test_can_get_stamp_list()
    {
        $this->withHeaders(['authorization' => $this->accessToken])
            ->get(route('members.stamps', $this->memberId))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get stamp list success',
                'data' => [],
            ])->assertJsonCount(2, 'data');
    }

    public function test_can_get_track_list()
    {
        $this->withHeaders(['authorization' => $this->accessToken])
            ->get(route('members.tracks', $this->memberId))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get track list success',
                'data' => [],
            ])->assertJsonCount(4, 'data');
    }

    public function test_cant_get_track_list()
    {
        $this->get(route('members.tracks', $this->memberId))
            ->assertStatus(401)
            ->assertJson([
                'status_code' => 401,
                'message' => 'MontBell Token Not Valid'
            ]);
    }

    public function test_can_get_latest_track()
    {
        $this->withHeaders(['authorization' => $this->accessToken])
            ->get(route('members.tracks', [
                'member' => $this->memberId,
                'order_by' => "id,desc",
                'limit' => "1",
            ]))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get track list success',
                'data' => [],
            ])->assertJsonCount(1, 'data');
    }

    public function test_can_get_notification_list()
    {
        $this->withHeaders(['authorization' => $this->accessToken])
            ->get(route('members.notifications', $this->memberId))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get notification list success',
                'data' => [],
            ])->assertJsonCount(3, 'data');
    }

    public function test_cant_get_notification_list()
    {
        $this->get(route('members.notifications', $this->memberId))
            ->assertStatus(401)
            ->assertJson([
                'status_code' => 401,
                'message' => 'MontBell Token Not Valid'
            ]);
    }

    public function test_can_update_notification()
    {
        $data = [
            'read_at' => now()
        ];
        $this->withHeaders(['authorization' => $this->accessToken])
            ->put(route('members.getNotification', [
                'member' => $this->memberId,
                'notification' =>  $this->notification_id,
            ]), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Update notification success',
                'data' => [],
            ]);
    }
}
