<?php

namespace App\Repositories;

abstract class EloquentRepository
{
    protected $request;

    public function __construct()
    {
        $this->setRequest();
    }

    public function setRequest()
    {
        $this->request = app()->make(
            $this->getRequest()
        );
    }

    abstract public function getRequest();
}