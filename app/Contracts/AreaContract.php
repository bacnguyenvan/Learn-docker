<?php

namespace App\Contracts;

interface AreaContract
{
    public function index();
    // public function show($id);

    public function show($area);
    public function getRoutesByArea($area);
    public function store($request);
    public function update($request, $area);
    public function destroy($area);
}
