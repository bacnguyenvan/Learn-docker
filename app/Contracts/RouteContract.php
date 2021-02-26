<?php

namespace App\Contracts;

interface RouteContract
{
    public function index($request);
    public function show($route);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
    public function filters();
    public function getRoutesByActivity($request);
}
