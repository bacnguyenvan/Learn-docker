<?php

namespace App\Contracts;

interface LandmarkContract
{
    public function index();
    public function show($landmark);
    public function store($request);
    public function update($request, $landmark);
    public function destroy($landmark);
}
