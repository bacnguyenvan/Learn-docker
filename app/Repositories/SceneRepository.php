<?php

namespace App\Repositories;

use App\Contracts\SceneContract;
use App\Traits\ResponseAPI;

class SceneRepository  implements SceneContract
{
    use ResponseAPI;

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $scenes = \App\Models\Scene::all();

            return $this->success('Get scene success', \App\Http\Resources\SceneResource::collection($scenes), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
