<?php

namespace Tests\Unit;

use Tests\UnitCase;

class MontBellTest extends UnitCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->montbell = new \App\Services\MontbellAPI;
        $this->member = [
            'username' => 'muratatest2',
            'password' => 'montbell0'
        ];
    }

    public function test_member_can_login()
    {
        $response = $this->montbell->login($this->member['username'], $this->member['password']);

        $this->assertCount(6, $response);
        $this->assertTrue($response['result_code'] == 1);
        $this->assertArrayHasKey('login_token', $response);
    }

    public function test_member_can_logout()
    {
        $responseLogin = $this->montbell->login($this->member['username'], $this->member['password']);

        $responseLogout = $this->montbell->logout($responseLogin['login_token']);

        $this->assertCount(3, $responseLogout);
        $this->assertTrue($responseLogout['result_code'] == 1);
    }

    public function test_member_can_get_info()
    {
        $responseLogin = $this->montbell->login($this->member['username'], $this->member['password']);

        $info = $this->montbell->infoMember($responseLogin['login_token']);

        $this->assertCount(22, $info);
        $this->assertTrue($info['result_code'] == 1);
    }

    public function test_member_is_token_valid()
    {
        $responseLogin = $this->montbell->login($this->member['username'], $this->member['password']);

        $isValid = $this->montbell->isTokenValid($responseLogin['login_token']);
        $this->assertTrue($isValid);
    }
}
