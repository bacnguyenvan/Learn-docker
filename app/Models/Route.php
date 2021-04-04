<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Route extends Model
{
    use HasFactory, SoftDeletes;

    const COMPOSITE_ACTIVITY_ID = 6;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that hold geometrical data.
     *
     * @var array
     */
    protected $geometry = ['geometry', 'point_center'];

    protected $hidden = ['pivot'];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'geometry' => \App\Casts\LineString::class,
        'point_center' => \App\Casts\Point::class,
    ];

  
    public function track()
    {
        return $this->hasMany('App\Models\Track')->setEagerLoads([]);
    }

    public function activities()
    {
        return $this->belongsToMany('App\Models\Activity', 'route_activity', 'route_id', 'activity_id')->setEagerLoads([]);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'route_tag', 'route_id', 'tag_id')->setEagerLoads([]);
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'area_id', 'id')->setEagerLoads([]);
    }

    public function scenes()
    {
        return $this->belongsToMany('App\Models\Scene', 'route_scene', 'route_id', 'scene_id')->setEagerLoads([]);
    }

    public function points()
    {
        return $this->belongsToMany('App\Models\Point', 'route_point', 'route_id', 'point_id')->orderBy('number', 'asc')->setEagerLoads([]);
    }

    public function landmarks()
    {
        return $this->belongsToMany('App\Models\Landmark', 'route_landmark', 'route_id', 'landmark_id')->setEagerLoads([]);
    }

    public function stamps()
    {
        return $this->belongsToMany('App\Models\Stamp', 'route_stamp', 'route_id', 'stamp_id')->setEagerLoads([]);
    }

    public function warnings()
    {
        return $this->belongsToMany('App\Models\Warning', 'route_warning', 'route_id', 'warning_id')->setEagerLoads([]);
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\Member', 'tracks', 'route_id', 'member_id')->setEagerLoads([]);
    }

    public function getMovementAttribute()
    {
        $movements = '';
        foreach($this->activities as $activity){
            $movements .= $activity['value']."_";
        }
        return trim($movements,"_");
    }

    /**
     * Calculation the distance from a point to other geometry
     *
     * @param Illuminate\Database\Query\Builder $query
     * @param float $latitude
     * @param float $longitude
     * @param int $distance
     * @return Illuminate\Database\Query\Builder
     */
    public function scopeGetByDistance($query, $latitude, $longitude, $distance = 50)
    {
        return $query->addSelect(
            DB::raw(
                "ST_Distance(ST_GeomFromText('POINT(${latitude} ${longitude})', 4326), `geometry`)/1000 as distance"
            )
        )->whereRaw(
            "ST_Distance(ST_GeomFromText('POINT(${latitude} ${longitude})', 4326), `geometry`)/1000 <= $distance"
        )->orderBy('distance');
    }

    /**
     * Get a new query builder for the model's table.
     * Manipulate in case we need to convert geometrical fields to json text.
     *
     * @param  bool  $excludeDeleted
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery($excludeDeleted = true)
    {
        if (!empty($this->geometry)) {
            $raw = '';
            foreach ($this->geometry as $column) {
                $raw .= 'ST_AsText(`routes`.`' . $column . '`, "axis-order=lat-long") as `' . $column . '`, ';
            }
            $raw = substr($raw, 0, -2);
            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }
        return parent::newQuery($excludeDeleted);
    }

    public function searchByActivity($request)
    {
       DB::enableQueryLog();
        $query = Route:: distinct('routes.id')
                ->  leftJoin('route_activity','route_activity.route_id','routes.id')
                ->  leftJoin('activities','activities.id','route_activity.activity_id')
                ->  leftJoin('areas','areas.id','routes.area_id')
                ->  leftJoin('area_prefecture','area_prefecture.area_id','areas.id')
                ->  leftJoin('prefectures','prefectures.id','area_prefecture.prefecture_id')
                ->  leftJoin('regions','regions.id','prefectures.region_id')
                ->  leftJoin('route_tag','routes.id','route_tag.route_id')
                ->  leftJoin('tags','tags.id','route_tag.tag_id');
        

        if(isset($request->activity_id) && $request->activity_id != self::COMPOSITE_ACTIVITY_ID){
            $query = $query -> where('route_activity.activity_id',$request->activity_id);
        }

        if(isset($request->region_id)){
            $regionId = explode(",",trim($request->region_id,','));
            $query = $query -> whereIn('prefectures.region_id',$regionId);
        }
                
        $query = $this->addSearchOptions($query,$request);

        $data = $query 
                ->  select('prefectures.name as prefecture_name','routes.id','routes.name as route_name','routes.number as route_number','areas.number as area_number','routes.stamina_level','routes.range','routes.journey_time','routes.total_elevation','routes.movement','routes.line_color')
                
                ->  get();
        dd(DB::getQueryLog());
        return $data;
    }

    public function addSearchOptions($query, $request)
    {
        if(isset($request->staminaLevelOptions)){
            $staminaLevel = explode(",",trim($request->staminaLevelOptions,','));
            $query = $query -> whereIn('routes.stamina_level',$staminaLevel);
        }

        if(isset($request->rangeOptions)){
            $ranges = explode(",",trim($request->rangeOptions,','));
            if(count($ranges) < 3){
                $rangeOptions = $this->customValue($ranges,$column = 'range');
                $query = $this->filterMultipOptions($query,$rangeOptions,$column = 'range');
            }
        }

        if(isset($request->journeyTimeOptions)){
            $journeyTimes = explode(",",trim($request->journeyTimeOptions,','));
            if(count($journeyTimes) < 3){
                $journeyTimeOptions = $this->customValue($journeyTimes,$column = 'journey_time');
                $query = $this->filterMultipOptions($query,$journeyTimeOptions,$column = 'journey_time');
            }
        }

        if(isset($request->totalElevationOptions)){
            $totalElevations = explode(",",trim($request->totalElevationOptions,','));
            if(count($totalElevations) < 3){
                $totalElevationOptions = $this->customValue($totalElevations,$column = 'total_elevation');
                $query = $this->filterMultipOptions($query,$totalElevationOptions,$column = 'total_elevation');
            }
        }

        if(isset($request->keySearch)){
            $keySearch = explode(",",trim($request->keySearch,','));
            $query = $query->where(function($q) use($keySearch){
                foreach($keySearch as $index => $value){
                    if($index == 0){
                        $query = $q->where('tags.name','like',  '%' . $value .'%');
                    }else{
                        $query = $q->orWhere('tags.name','like',  '%' . $value .'%');
                    }
                }
            });
        }

        return $query;
    }

    public function filterMultipOptions($query,$options,$column)
    {
        $query = $query->where(function($q) use($options,$column){
            foreach($options as $index => $option){

                $values = explode('_',$option);
                
                if(is_numeric($values[0])){ //first element is number
                    if($index == 0){
                        $q->whereBetween($column,$values);
                    }else{
                        $q->orWhereBetween($column,$values);
                    }
                }else{
                    // >_180 : explode('_',$option) -> [0] => ">" , [1] => 180
                    if($index == 0){
                        $q->where($column,$values[0],$values[1]);
                    }else{
                        $q->orWhere($column,$values[0],$values[1]);
                    }
                }
            }
        });

        return $query;
    }

    public function customValue($oldData,$column)
    {
        $newData = [];
        foreach($oldData as $item){
            if($item == 1){
                if($column == 'range'){
                    array_push($newData,"<_30");
                }else if($column == 'journey_time'){
                    array_push($newData,"<_240");
                }else if($column == 'total_elevation'){
                    array_push($newData,"<_300");
                }

            }else if($item == 2){
                if($column == 'range'){
                    array_push($newData,"30_80");
                }else if($column == 'journey_time'){
                    array_push($newData,"240_320");
                }else if($column == 'total_elevation'){
                    array_push($newData,"300_800");
                }

            }else if($item == 3){
                if($column == 'range'){
                    array_push($newData,">_80");
                }else if($column == 'journey_time'){
                    array_push($newData,">_320");
                }else if($column == 'total_elevation'){
                    array_push($newData,">_800");
                }
            } 
        }
        return $newData;
    }
}
