<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberTrackResource extends JsonResource
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
            'route_id' => $this->route_id,
            'route_name' => $this->route->name,
            'route_description' => $this->route->description,
            'member_id' => $this->member_id,
            'name' => $this->name,
            'description' => $this->description,
            'diff_elevation' => $this->diff_elevation,
            'total_elevation' => $this->total_elevation,
            'time' => $this->total_time,
            'distance' => $this->total_distance,
            'sum_elevation' => $this->sum_elevation,
            'sum_time' => $this->sum_time,
            'sum_distance' => $this->sum_distance,
            'type' => $this->type,
            'created_at' => $this->created_at,
        ];
    }
}
