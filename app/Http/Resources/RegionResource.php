<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
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
            'name' => $this->name,
            'ne_latitude' => $this->ne_latitude,
            'ne_longtitude' => $this->ne_longtitude,
            'sw_latitude' => $this->sw_latitude,
            'sw_longtitude' => $this->sw_longtitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
