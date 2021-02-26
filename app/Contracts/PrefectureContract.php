<?php

namespace App\Contracts;

interface PrefectureContract
{
    public function index();
    public function show($prefecture);
    public function store($request);
    public function update($request, $prefecture);
    public function destroy($prefecture);
}
