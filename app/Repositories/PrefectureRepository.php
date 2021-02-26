<?php

namespace App\Repositories;

use App\Contracts\PrefectureContract;
use App\Repositories\EloquentRepository;
use App\Traits\ResponseAPI;

class PrefectureRepository implements PrefectureContract
{
    use ResponseAPI;

    public function index()
    {
        $prefectures = \App\Models\Prefecture::all();
        return $this->success('Get all prefecture success', \App\Http\Resources\PrefectureResource::collection($prefectures), 200);
    }

    public function show($prefecture)
    {
        //
    }

    public function store($request)
    {
        try {
            $prefecture = \App\Models\Prefecture::create($request->all());
            return $this->success('Store prefecture success', \App\Http\Resources\PrefectureResource::make($prefecture), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function update($request, $prefecture)
    {
        try {
            foreach ($request->all() as $key => $value) {
                $prefecture[$key] = $value;
            }
            $prefecture->save();

            return $this->success('Update prefecture success', \App\Http\Resources\PrefectureResource::make($prefecture), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function destroy($prefecture)
    {
        try {
            $prefecture->delete();
            return $this->success('Delete prefecture success', \App\Http\Resources\PrefectureResource::make($prefecture), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
