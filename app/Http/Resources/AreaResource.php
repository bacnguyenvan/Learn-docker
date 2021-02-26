<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;
class AreaResource extends JsonResource
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
        
        return [
            'id' => $this->id,
            'prefecture_id' => $this->prefecture_id,
            'number' => $this->number,
            'name' => $this->name,
            'thumbnail' => $urlApp.'/'.$this->thumbnail,
            'slogan' => $this->slogan,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longtitude' => $this->longtitude,
            'zoom_level' => $this->zoom_level,
            'catalog_file' => $this->catalog_file,
            'map_file' => $this->map_file,
            'prefecture' => $this->prefecture,
            'photos' => $this->photos,
            'center_pointer' => $this->center_pointer
        ];
    }
}
