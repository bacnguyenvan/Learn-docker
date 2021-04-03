<?php

namespace App\Repositories;

use App\Contracts\AreaContract;
use App\Traits\ResponseAPI;
use App\Models\Area;
use App\Models\Prefecture;
use App\Services\AreaService;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AreaRepository  implements AreaContract
{
    use ResponseAPI;
    private $areaService;
    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }
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

    protected function createOrUpdate(?Area $area = null, $inputs)
    {
        if (is_null($area)) {
            $area = Area::create($inputs);
        } else {
            $area->update($inputs);
        }

        $prefecture_ids = Prefecture::whereIn('id', $inputs['prefecture_id'])
            ->select('id')
            ->pluck('id')
            ->toArray();
        $diff = array_diff($inputs['prefecture_id'], $prefecture_ids);
        if (count($diff)) {
            throw new Exception(sprintf('Prefecture not found (ID: %s)', implode(',', $diff)));
        }

        $area->prefectures()->sync($prefecture_ids);

        return $area;
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
            DB::beginTransaction();
            $inputs = $this->areaService->getRequest($request);
            $area = $this->createOrUpdate(null, $inputs);

            $this->areaService->createAreaPhotos($request,$area);
            DB::commit();

            return $this->success('Insert area success', \App\Http\Resources\AreaResource::make($area), 200);
        } catch (\Exception $err) {
            DB::rollBack();
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
            DB::beginTransaction();
            $inputs = $this->areaService->getRequest($request);
            $this->createOrUpdate($area, $inputs);

            $this->areaService->updateAreaPhotos($request,$area);
            DB::commit();

            return $this->success('Update area success', \App\Http\Resources\AreaResource::make($area->fresh()), 200);
        } catch (\Exception $err) {
            DB::rollBack();
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
            \App\Models\AreaPhoto::deleteAreas($area->id);
            $area->delete();
            return $this->success('Delete area success', \App\Http\Resources\AreaResource::make($area), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function getLandmarksByArea($area)
    {
        try {
            $landmarks = $area->landmarks;
            return $this->success('Get landmarks success', \App\Http\Resources\LandmarkResource::collection($landmarks), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
