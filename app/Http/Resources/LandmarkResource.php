<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LandmarkResource extends JsonResource
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
            'description' => $this->description,
            'icon' => $this->icon,
            'thumbnail' => $this->thumbnail,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'category' => $this->category,
            'address' => $this->address,
            'tel' => $this->tel,
        ];
    }
}
