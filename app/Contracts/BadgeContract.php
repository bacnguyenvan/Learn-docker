<?php

namespace App\Contracts;

interface BadgeContract
{
    public function index();
    public function show($badge);
    public function store($request);
    public function update($request, $badge);
    public function destroy($badge);
}
