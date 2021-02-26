<?php

namespace App\Repositories;

use App\Contracts\RegionContract;
use App\Traits\ResponseAPI;
use App\Models\Area;

class RegionRepository  implements RegionContract
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
            $regions = \App\Models\Region::all();

            return $this->success('Get region success', \App\Http\Resources\RegionResource::collection($regions), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $region
     * @return void
     */
    public function show($region)
    {
        try {
            return $this->success('Get region success', \App\Http\Resources\RegionResource::make($region), 200);
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
            $region = \App\Models\Region::create($request->all());

            return $this->success('Insert region success', \App\Http\Resources\RegionResource::make($region), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $region
     * @return void
     */
    public function update($request, $region)
    {
        try {
            foreach ($request->all() as $key => $value) {
                $region[$key] = $value;
            }
            $region->save();

            return $this->success('Update region success', \App\Http\Resources\RegionResource::make($region), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * destroy
     *
     * @param  mixed $region
     * @return void
     */
    public function destroy($region)
    {
        try {
            $region->delete();

            return $this->success('Delete region success', \App\Http\Resources\RegionResource::make($region), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function getAreasByRegion($region)
    {
        try {
            $areas = Area::whereHas('prefecture', function ($query) use ($region) {
                $query->where('region_id', $region);
            })->orderby('number', 'asc')
                ->get();

            // $areas = Area::whereHas('prefecture', function ($query) use ($region) {
            //     $query->where('id', $region);
            // })->orderby('number', 'asc')
            // -> get();
            // Get latitude, longtitude center_point of map by list areas
            $latitude = 0.0;
            $longtitude = 0.0;
            foreach ($areas as $area) {
                $latitude += $area->latitude;
                $longtitude += $area->longtitude;
            }
            $centerLat = $latitude / count($areas);
            $centerLon = $longtitude / count($areas);

            foreach ($areas as $area) {
                $area->center_pointer = [
                    'centerLat' => $centerLat,
                    'centerLon' => $centerLon
                ];
            }

            if (count($areas) > 0) {
                return $this->success('Get area success', \App\Http\Resources\AreaResource::collection($areas));
            } else {
                throw new \App\Exceptions\AreaNotExistException;
            }
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
