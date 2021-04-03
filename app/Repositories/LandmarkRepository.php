<?php

namespace App\Repositories;

use App\Contracts\LandmarkContract;
use App\Traits\ResponseAPI;
use App\Traits\UploadFileAPI;
use App\Services\LandmarkService;

class LandmarkRepository  implements LandmarkContract
{
    use ResponseAPI, UploadFileAPI;

    private $landmarkService;
    public function __construct(LandmarkService $landmarkService)
    {
        $this->landmarkService = $landmarkService;
    }
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $landmarks = \App\Models\Landmark::all();

            return $this->success('Get landmark success', \App\Http\Resources\LandmarkResource::collection($landmarks), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $landmark
     * @return void
     */
    public function show($landmark)
    {
        try {
            return $this->success('Get landmark success', \App\Http\Resources\LandmarkResource::make($landmark), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store($request)
    {
        try {
            $inputs =  $this->landmarkService->getInputs($request);
            $landmark = \App\Models\Landmark::create($inputs);
            return $this->success('Insert landmark success', \App\Http\Resources\LandmarkResource::make($landmark->fresh()), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update($request, $landmark)
    {
        try {
            $inputs =  $this->landmarkService->getInputs($request);
            foreach ($inputs as $key => $value) {
                $landmark[$key] = $value;
            }
            $landmark->save();

            return $this->success('Update landmark success', \App\Http\Resources\LandmarkResource::make($landmark->fresh()), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($landmark)
    {
        try {
            $landmark->delete();

            return $this->success('Delete landmark success', \App\Http\Resources\LandmarkResource::make($landmark), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
