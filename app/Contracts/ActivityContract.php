<?php

namespace App\Contracts;

interface ActivityContract
{
    public function index();
    public function show($activity);
    public function store($request);
    public function update($request, $activity);
    public function destroy($activity);
}
