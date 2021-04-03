<?php

namespace App\Contracts;

interface AdminContract
{
    public function index();
    public function show($admin);
    public function store($request);
    public function update($request, $admin);
    public function destroy($admin);
    public function login($requets);
    public function refreshToken();
    public function logout();
}
