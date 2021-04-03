<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Helpers\Helper;
class AreaPhotoResource extends JsonResource
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
            'url' => $urlApp.'/'. $this->url,
            'caption' => $this->caption
        ];
    }
}
