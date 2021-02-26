<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PointResource extends JsonResource
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
            'support_id' => $this->support_id,
            'name' => $this->name,
            'number' => $this->number,
            'category' => $this->category,
            'title' => $this->title,
            'description' => $this->description,
            'address' => $this->address,
            'tel' => $this->tel,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'elevation' => $this->elevation,
            'thumbnail' => $this->thumbnail,
            'distance_to_next' => $this->distance_to_next,
            'time_to_next' => $this->time_to_next,
            'site_url' => $this->site_url,
            'montbell_friend_shop' => $this->montbell_friend_shop,
            'other' => $this->other,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
