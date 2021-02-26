<?php

namespace App\Repositories;

use App\Contracts\PointContract;
use App\Traits\ResponseAPI;
use App\Traits\UploadFileAPI;

class PointRepository  implements PointContract
{
    use ResponseAPI, UploadFileAPI;

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $points = \App\Models\Point::all();

            return $this->success('Get point success', \App\Http\Resources\PointResource::collection($points), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $point
     * @return void
     */
    public function show($point)
    {
        try {
            return $this->success('Get point success', \App\Http\Resources\PointResource::make($point), 200);
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
            $point = \App\Models\Point::create($request->all());

            return $this->success('Insert point success', \App\Http\Resources\PointResource::make($point->fresh()), 200);
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
    public function update($request, $point)
    {
        try {
            foreach ($request->all() as $key => $value) {
                $point[$key] = $value;
            }
            $point->save();

            return $this->success('Update point success', \App\Http\Resources\PointResource::make($point->fresh()), 200);
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
    public function destroy($point)
    {
        try {
            $point->delete();

            return $this->success('Delete point success', \App\Http\Resources\PointResource::make($point), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
