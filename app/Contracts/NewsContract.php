<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface NewsContract
{
    public function index($request);
    public function indexAdmin($request);
    public function show(Request $request, $news);
    public function showAdmin(Request $request, $news);
    public function store($request);
    public function update($request, $news);
    public function destroy($news);
}
