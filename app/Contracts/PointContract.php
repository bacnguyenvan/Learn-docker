<?php

namespace App\Contracts;

interface PointContract
{
    public function index();
    public function show($point);
    public function store($request);
    public function update($request, $point);
    public function destroy($point);
}
