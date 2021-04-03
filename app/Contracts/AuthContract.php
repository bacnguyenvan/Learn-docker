<?php

namespace App\Contracts;

interface AuthContract
{
    public function login($request);
    public function logout();
}
