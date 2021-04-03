<?php

namespace App\Repositories;

use App\Contracts\StampContract;
use App\Traits\ResponseAPI;
use App\Traits\UploadFileAPI;

class StampRepository  implements StampContract
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
            $stamps = \App\Models\Stamp::all();

            return $this->success('Get stamp success', \App\Http\Resources\StampResource::collection($stamps), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $stamp
     * @return void
     */
    public function show($stamp)
    {
        try {
            return $this->success('Get stamp success', \App\Http\Resources\StampResource::make($stamp), 200);
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
            $inputs = [
                'description' => $request->description,
                'name' => $request->name,
                'type' => $request->type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'thumbnail' => $request->type // thumbnail = type, different display
            ];
            $stamp = \App\Models\Stamp::create($inputs);

            return $this->success('Insert stamp success', \App\Http\Resources\StampResource::make($stamp->fresh()), 200);
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
    public function update($request, $stamp)
    {
        try {
            $inputs = [
                'description' => $request->description,
                'name' => $request->name,
                'type' => $request->type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'thumbnail' => $request->type // thumbnail = type, different display
            ];
            foreach ($inputs as $key => $value) {
                $stamp[$key] = $value;
            }
            $stamp->save();

            return $this->success('Update stamp success', \App\Http\Resources\StampResource::make($stamp->fresh()), 200);
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
    public function destroy($stamp)
    {
        try {
            $stamp->delete();

            return $this->success('Delete stamp success', \App\Http\Resources\StampResource::make($stamp), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
