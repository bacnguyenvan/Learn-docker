<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Helpers\Helper;
class RouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $badgeThumbnail =  Helper::getThumbnailByActivities($type = 'badge',$this->activities);
        $stampThumbnail =  Helper::getThumbnailByActivities($type = 'stamp',$this->activities);
        $stampsByPoints = Helper::getStampsByPoints($this->points,$stampThumbnail);

        return [
            'id' => $this->id,
            'area_id' => $this->area_id,
            'number' => $this->number,
            'name' => $this->name,
            'description' => $this->description,
            'movement' => $this->movement,
            'stamina_level' => $this->stamina_level,
            'range' => $this->range,
            'diff_elevation' => $this->diff_elevation,
            'total_elevation' => $this->total_elevation,
            'journey_time' => $this->journey_time,
            'line_color' => $this->line_color,
            'geometry' => $this->geometry,
            'point_center' => $this->point_center,
            'zoom_level' => $this->zoom_level??14.5,
            'badge_thumbnail' => $badgeThumbnail,
            'stamp_thumbnail' => $stampThumbnail,
            'activities' => $this->activities,
            'points' => PointResource::collection($this->points),
            'landmarks' => LandmarkResource::collection($this->landmarks),
            'stamps' => StampCustomResource::collection($stampsByPoints),
            'tags' => $this->tags,
            'area' => $this->area,
            'warnings' => $this->warnings,
            'graph' => $this->graph ? $this->graph : null,
        ];
    }
}
