<?php

namespace App\Http\Controllers;

use App\Contracts\PrefectureContract;

class PrefectureController extends Controller
{
    private $repo;

    public function __construct(PrefectureContract $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return $this->repo->index();
    }

    public function show(\App\Models\Prefecture $prefecture)
    {
        return $this->repo->show($prefecture);
    }

    public function store($request)
    {
        return $this->repo->store($request);
    }

    public function update($request, \App\Models\Prefecture $prefecture)
    {
        return $this->repo->update($request, $prefecture);
    }

    public function destroy(\App\Models\Prefecture $prefecture)
    {
        return $this->repo->destroy($prefecture);
    }
}
