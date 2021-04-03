<?php

namespace App\Services;
class AdminService
{
    public function getAdminAccessToken($admin)
    {
        $accessToken = $admin->createToken('admin')->plainTextToken;
        $admin->access_token = $accessToken;
        $admin->save();
        request()->headers->set('authorization', $accessToken);

        $data = [
            'name' => $admin->name,
            'email' => $admin->email,
            'access_token' => $accessToken,
            'token_type' => 'Bearer'
        ];

        return $data;
    }
}
