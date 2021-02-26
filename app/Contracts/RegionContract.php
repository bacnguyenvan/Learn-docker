<?php

namespace App\Contracts;

interface RegionContract
{
    public function index();
    public function show($region);
    public function store($request);
    public function update($request, $region);
    public function destroy($region);
}
