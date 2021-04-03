<?php

namespace App\Repositories;

use App\Contracts\RouteContract;
use App\Models\Route;
use App\Traits\ResponseAPI;
use App\Traits\GeometryChart;
use Illuminate\Pipeline\Pipeline;
use App\Http\Helpers\Helper;
use App\Services\RouteService;
use Illuminate\Support\Facades\File;
use App\Jobs\DownloadRoute;

class RouteRepository  implements RouteContract
{
    private $routeService;
    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }
    use ResponseAPI, GeometryChart;
    /**
     *
     */
    public function index($request)
    {
        try {
            $routes = Route::all();
            return $this->success('Get all route success', \App\Http\Resources\RouteResource::collection($routes), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $route
     * @return void
     */
    public function show($route)
    {
        try {
            $graph = $this->getGeoChart($route['id'], $route['geometry'], $route['range'], $route['diff_elevation']);
            $route['graph'] = $graph;
            return $this->success('Get route success', \App\Http\Resources\RouteResource::make($route), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function getTiles($route)
    {
        if (!empty($route)) {
            try {
                // Helper::debug("start route_id=$route->id");
                // $helpers = new Helper();
                // for ($zoom = 15; $zoom <= 18; $zoom++) {
                //     $data = $helpers->calculatorTiles($route, $zoom);
                //     $helpers->getTiles($data, $zoom, $route->id);
                // }
                // //download elevation for zoom = 14
                // $data = $helpers->calculatorTiles($route, $zoom = 14);
                // $helpers->getElevations($data, 14, $route->id);

                // $helpers->zipFiles($route->id);
                // \Illuminate\Support\Facades\File::deleteDirectory(public_path("route_data/route_$route->id/tiles"));
                // Helper::debug("end   route_id=$route->id");
                dispatch(new DownloadRoute($route));

                return true;
            } catch (\Exception $err) {
                throw $err;
            }
        }
    }

    /**
     *
     */
    public function store($request)
    {
        try {
            $inputs = $this->routeService->getInputs($request);
            $inputSave = $inputs['requests'];
            
            $route = Route::create($inputSave);
            
            $this->routeService->saveDataSync($route,$inputs);

            $route = Route::findOrFail($route->id);
            return $this->success('Insert route success', \App\Http\Resources\RouteResource::make($route), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function update($request, $route)
    {
        try {
            $inputs = $this->routeService->getInputs($request);
            $inputSave = $inputs['requests'];

            // check the same geometry
            $check = $this->routeService->checkGeometryDuplicate($request, $route);
            if(!$check){
                dispatch(new DownloadRoute($route))->onQueue("low");
            }
            $route->update($inputSave);
            $this->routeService->saveDataSync($route,$inputs);


            $route = \App\Models\Route::findOrFail($route->id); // response

            return $this->success('Update route success', \App\Http\Resources\RouteResource::make($route), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function destroy($route)
    {
        try {
            $route->delete();

            return $this->success('Delete route success', \App\Http\Resources\RouteResource::make($route), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function filters()
    {
        $routes = Route::query();
        $pipeline = app(Pipeline::class)
            ->send($routes)
            ->through([
                \App\QueryFilters\Area::class,
                \App\QueryFilters\Tags::class,
                \App\QueryFilters\Activities::class,
                \App\QueryFilters\Scenes::class,
                \App\QueryFilters\Position::class
            ])
            ->thenReturn();

        return $this->success('Get list routes success', $pipeline->get());
    }

    public function getRoutesByActivity($request)
    {
        $routeModel = new \App\Models\Route();
        $data = $routeModel->searchByActivity($request);
        return $this->success('Get list routes success', $data);
    }
    
    public function destroyBadge($route_id)
    {
        try {
            $route = \App\Models\Route::findOrFail($route_id);
            $image_path = $route->badge_thumbnail;
            $route->badge_thumbnail = null;
            $route->save();
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            return $this->success('Delete badge success', \App\Http\Resources\RouteResource::make($route) , 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
