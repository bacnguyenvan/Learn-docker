<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Helpers\Helper;
class StampCustomResource extends JsonResource
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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'thumbnail' => $this->stamp_thumbnail,
            'distance_get_stamp' => $this->distance_get_stamp,
            'name' => $this->name
        ];
    }
}
