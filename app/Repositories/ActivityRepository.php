<?php

namespace App\Repositories;

use App\Contracts\ActivityContract;
use App\Traits\ResponseAPI;

class ActivityRepository  implements ActivityContract
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
            $activities = \App\Models\Activity::all();

            return $this->success('Get activity success', \App\Http\Resources\ActivityResource::collection($activities), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $activity
     * @return void
     */
    public function show($activity)
    {
        try {
            return $this->success('Get activity success', \App\Http\Resources\ActivityResource::make($activity), 200);
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
            $activity = \App\Models\Activity::create($request->all());

            return $this->success('Insert activity success', \App\Http\Resources\ActivityResource::make($activity), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $activity
     * @return void
     */
    public function update($request, $activity)
    {
        try {
            foreach ($request->all() as $key => $value) {
                $activity[$key] = $value;
            }
            $activity->save();

            return $this->success('Update activity success', \App\Http\Resources\ActivityResource::make($activity), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * destroy
     *
     * @param  mixed $activity
     * @return void
     */
    public function destroy($activity)
    {
        try {
            $activity->delete();

            return $this->success('Delete activity success', \App\Http\Resources\ActivityResource::make($activity), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
