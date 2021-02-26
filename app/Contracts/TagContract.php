<?php

namespace App\Contracts;

interface TagContract
{
    public function index();
    public function show($tag);
    public function store($request);
    public function update($request, $tag);
    public function destroy($tag);
}
