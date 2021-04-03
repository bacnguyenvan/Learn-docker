<?php

namespace App\Http\Controllers;


class SceneController extends Controller
{
    private $repo;

    public function __construct(\App\Contracts\SceneContract $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return $this->repo->index();
    }
}
