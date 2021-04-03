<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaRouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'area_id' => $this->area_id,
            'number' => $this->number,
            'name' => $this->name,
            'movement' => $this->movement,
            'stamina_level' => $this->stamina_level,
            'range' => $this->range,
            'diff_elevation' => $this->diff_elevation,
            'total_elevation' => $this->total_elevation,
            'journey_time' => $this->journey_time,
            'line_color' => $this->line_color,
            'geometry' => $this->geometry,
        ];
    }
}
