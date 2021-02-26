<?php

namespace App\Repositories;

use App\Contracts\RouteContract;
use App\Models\Route;
use App\Traits\ResponseAPI;
use App\Traits\GeometryChart;
use Illuminate\Pipeline\Pipeline;
use Helper;
use DB;

class RouteRepository  implements RouteContract
{
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
                $helpers = new Helper();
                for ($zoom = 15; $zoom <= 18; $zoom++) {
                    $data = $helpers->caculatorTiles($route, $zoom);
                    $helpers->getTiles($data, $zoom, $route->id);
                }
                //download elevation for zoom = 14
                $data = $helpers->caculatorTiles($route, $zoom = 14);
                $helpers->getElevations($data, 14, $route->id);

                $helpers->zipFiles($route->id);
                \Illuminate\Support\Facades\File::deleteDirectory(public_path("route_data/route_$route->id/"));
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
            $route = Route::create($request->all());
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
            foreach ($request->all() as $key => $value) {
                $route[$key] = $value;
            }
            $route->save();

            return $this->success('Update route success', [
                'status_code' => 200,
                'data' => $route
            ], 200);
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

    
}
