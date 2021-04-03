<?php 
namespace App\Services;
use App\Http\Helpers\Helper;
class RouteService{

    public function getInputs($request)
    {
        
        $inputs['requests'] = [
            'area_id' => $request->area_id,
            'number' => $request->number,
            'name' => $request->name,
            'description' => $request->description,
            'movement' => $request->movement,
            'stamina_level' => $request->stamina_level,
            'range' => $request->range,
            'total_elevation' => $request->total_elevation,
            'diff_elevation' => $request->diff_elevation,
            'journey_time' => $request->journey_time,
            'line_color' => $request->line_color,
            'geometry' => $request->geometry,
            'point_center' => $request->point_center,
            'zoom_level' => $request->zoom_level,
        ];
        
        if(!empty($request->landmark_id)){
            $inputs['sync']['landmark_id'] = $request->landmark_id;
        }

        if(!empty($request->point_id)){
            $inputs['sync']['point_id'] = $request->point_id;
        }

        if(!empty($request->tag_id)){
            $inputs['sync']['tag_id'] = $request->tag_id;
        }

        if(!empty($request->warning_id)){
            $inputs['sync']['warning_id'] = $request->warning_id;
        }
        
        if(!empty($request->activity_id)){
            $inputs['sync']['activity_id'] = $request->activity_id;
        }

        return $inputs;
    }

    public function saveDataSync($route, $inputs)
    {
        if(!empty($inputs['sync'])){
            $inputSyns = $inputs['sync'];
            if(!empty($inputSyns['landmark_id'])){
                $route->landmarks()->sync($inputSyns['landmark_id']);
            }

            if(!empty($inputSyns['point_id'])){
                $route->points()->sync($inputSyns['point_id']);
            }

            if(!empty($inputSyns['tag_id'])){
                $route->tags()->sync($inputSyns['tag_id']);
            }

            if(!empty($inputSyns['warning_id'])){
                $route->warnings()->sync($inputSyns['warning_id']);
            }

            if(!empty($inputSyns['activity_id'])){
                $route->activities()->sync($inputSyns['activity_id']);
            }
        }
    }

    public function checkGeometryDuplicate($request, $route)
    {
        $geometries = $request->geometry;
        $geometriesConvert = [];
        foreach($route->geometry as $item){
            array_push($geometriesConvert,implode(" ",$item));
        }
        $result  = array_diff($geometriesConvert,$geometries);
        

        if(count($geometriesConvert) == count($geometries) && empty($result)){
            return true;
        }

        return false;
    }

}



