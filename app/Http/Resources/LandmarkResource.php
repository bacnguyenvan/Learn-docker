<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;
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
        $urlApp = Helper::getUrlApplication();
        return [
            'id' => $this->id,
            'area_id' => $this->area_id,
            'name' => $this->name,
            'description' => $this->description,
            'thumbnail' => $urlApp.'/'.$this->thumbnail,
            'support' => $this->support,
            'category' => $this->category,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'tel' => Helper::formatPhone($this->tel),
            'is_member_benefit' => $this->is_member_benefit,
            'site_url' => $this->site_url,
            'montbell_friend_shop' => $this->montbell_friend_shop
        ];
    }
}
