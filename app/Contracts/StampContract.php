<?php

namespace App\Contracts;

interface StampContract
{
    public function index();
    public function show($stamp);
    public function store($request);
    public function update($request, $stamp);
    public function destroy($stamp);
}
