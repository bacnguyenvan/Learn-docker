<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Helpers\Helper;
class AppInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $url = Helper::getUrlApplication();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'version' => $this->version,
            'term_service' => $this->term_service,
            'home_background' => $url.'/'.$this->home_background,
            'caption' => $this->caption,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
