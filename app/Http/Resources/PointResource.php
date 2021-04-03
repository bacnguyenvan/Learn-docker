<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Helpers\Helper;
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
        $urlApp = Helper::getUrlApplication();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number,
            'start_finish' => $this->start_finish,
            'description' => $this->description,
            'heading' => $this->heading,
            'address' => $this->address,
            'tel' => $this->tel,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'thumbnail' => $urlApp.'/'.$this->thumbnail,
            'support' => $this->support,
            'distance_get_stamp' => $this->distance_get_stamp,
            'distance_to_next' => $this->distance_to_next??0,
            'time_to_next' => $this->time_to_next??0,
            'is_member_benefit' => $this->is_member_benefit,
            'site_url' => $this->site_url,
            'montbell_friend_shop' => $this->montbell_friend_shop,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
