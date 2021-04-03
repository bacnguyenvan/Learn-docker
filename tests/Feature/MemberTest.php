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
        $this->newsId = 1;
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

    public function test_can_get_news_list()
    {
        $this->withHeaders(['authorization' => $this->accessToken])
            ->get(route('members.news', $this->memberId))
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Get news list success',
                'data' => [],
            ])->assertJsonCount(3, 'data');
    }

    public function test_cant_get_news_list()
    {
        $this->get(route('members.news', $this->memberId))
            ->assertStatus(401)
            ->assertJson([
                'status_code' => 401,
                'message' => 'MontBell Token Not Valid'
            ]);
    }

    public function test_can_update_news()
    {
        $data = [
            'read_at' => now()->format("Y-m-d H:i:s")
        ];
        $this->withHeaders(['authorization' => $this->accessToken])
            ->put(route('members.updateNews', [
                'member' => $this->memberId,
                'news' =>  $this->newsId,
            ]), $data)
            ->assertStatus(200)
            ->assertJson([
                'status_code' => 200,
                'message' => 'Update news success',
                'data' => [],
            ]);
    }
}
