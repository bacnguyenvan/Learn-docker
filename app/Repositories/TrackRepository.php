<?php

namespace App\Repositories;

use App\Contracts\TrackContract;
use App\Models\Track;
use App\Traits\ResponseAPI;

class TrackRepository  implements TrackContract
{
    use ResponseAPI;

    /**
     *
     */
    public function index()
    {
        try {
            $tracks = Track::all();

            return $this->success('Get all track success', \App\Http\Resources\TrackResource::collection($tracks), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function show($track)
    {
        try {
            return $this->success('Get track success', \App\Http\Resources\TrackResource::make($track), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function store($request)
    {
        try {
            $track = Track::create($request->all());

            return $this->success('Insert track success', \App\Http\Resources\TrackResource::make($track), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function update($request, $track)
    {
        try {
            foreach ($request->all() as $key => $value) {
                $track[$key] = $value;
            }
            $track->save();

            return $this->success('Update track success', \App\Http\Resources\TrackResource::make($track), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function destroy($track)
    {
        try {
            $track->delete();

            return $this->success('Delete track success', \App\Http\Resources\TrackResource::make($track), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
