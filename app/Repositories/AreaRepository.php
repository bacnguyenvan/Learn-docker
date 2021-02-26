<?php

namespace App\Repositories;

use App\Contracts\AreaContract;
use App\Traits\ResponseAPI;
use App\Models\Area;
use Helper;

class AreaRepository  implements AreaContract
{
    use ResponseAPI;

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $areas = Area::orderby('number', 'asc')->get();

        return $this->success('Get areas list success', \App\Http\Resources\AreaResource::collection($areas));
    }

    // /**
    //  * show Area List By Prefecture
    //  *
    //  * @param  mixed $id
    //  * @return void
    //  */
    // public function show($id)
    // {
    //     try {
    //         $area = Area::whereHas('prefecture', function ($query) use ($id) {
    //             $query->where('id', $id);
    //         })->orderby('number', 'asc')->get();
    //         if (count($area) > 0) return $this->success('Get area success', \App\Http\Resources\AreaResource::collection($area));
    //         else throw new \App\Exceptions\AreaNotExistException;
    //     } catch (\Exception $err) {
    //         throw $err;
    //     }
    // }

    public function show($area)
    {
        try {
            return $this->success('Get area success', \App\Http\Resources\AreaResource::make($area), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
    public function getRoutesByArea($area)
    {
        try {
            $routeList = $area->routes;
            return $this->success('Get area success', \App\Http\Resources\AreaRouteResource::collection($routeList), 200);
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

            $inputs = $this->getRequest($request);
            
            $area = \App\Models\Area::create($inputs);

            return $this->success('Insert area success', \App\Http\Resources\AreaResource::make($area), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $area
     * @return void
     */
    public function update($request, $area)
    {
        try {
            $data = $this->getRequest($request);
            foreach ($data as $key => $value) {
                $area[$key] = $value;
            }
            $area->save();

            return $this->success('Update area success', \App\Http\Resources\AreaResource::make($area), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * destroy
     *
     * @param  mixed $area
     * @return void
     */
    public function destroy($area)
    {
        try {
            $area->delete();

            return $this->success('Delete area success', \App\Http\Resources\AreaResource::make($area), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function getRequest($request)
    {
        $inputs = [
            'prefecture_id' => $request->prefecture_id,
            'number' => $request->number,
            'name' => $request->name,
            'slogan' => $request->slogan,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude,
            'zoom_level' => $request->zoom_level,
            'catalog_file' => $request->catalog_file,
            'map_file' => $request->map_file
        ];
        if($request->hasFile('thumbnail')){
            $filePath = Helper::areaImagePath;
            $file = $request->thumbnail;
            
            $fileName = $filePath.$file->getClientOriginalName();
            $file->move($filePath,$fileName);
            $inputs['thumbnail'] = $fileName;
        }

        return $inputs;
    }
}
