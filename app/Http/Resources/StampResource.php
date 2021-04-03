<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;
class StampResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $urlApp = Helper::getUrlApplication();
        $path = $urlApp.'/'.Helper::stampImagePath;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'thumbnail' => $path.'stamp_'.$this->thumbnail.'.png',
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
