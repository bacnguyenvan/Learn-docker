<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'version' => $this->version,
            'term_service' => $this->term_service,
            'home_background' => $this->home_background,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
