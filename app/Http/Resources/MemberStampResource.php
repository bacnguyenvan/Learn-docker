<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberStampResource extends JsonResource
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
            'id' => $this->stamp->id,
            'name' => $this->stamp->name,
            'description' => $this->stamp->description,
            'latitude' => $this->stamp->latitude,
            'longitude' => $this->stamp->longitude,
            'thumbnail' => $this->stamp->thumbnail,
            'type' => $this->stamp->type,
            'created_at' => $this->created_at,
            'route' => [
                'id' => $this->route->id,
                'area_id' => $this->route->area_id,
                'number' => $this->route->number,
                'name' => $this->route->name,
                'description' => $this->route->description,
                'movement' => $this->route->movement,
                'stamina_level' => $this->route->stamina_level,
                'range' => $this->route->range,
                'diff_elevation' => $this->route->diff_elevation,
                'total_elevation' => $this->route->total_elevation,
                'journey_time' => $this->route->journey_time,
            ],
            'member' => new MemberResource($this->member)
        ];
    }
}
