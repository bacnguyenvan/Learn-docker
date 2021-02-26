<?php

namespace App\Http\Requests;

class PointPutRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'area_id' => 'integer',
            'support_id' => 'integer',
            'name' => 'string|max:190',
            'number' => 'integer',
            'index' => 'integer|integer',
            'title' =>  'string|max:190',
            'description' =>  'string',
            'address' => 'string|max:190',
            'tel' => 'string|max:190',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'elevation' => 'numeric',
            'thumbnail' => 'file|max:2048|mimes:jpeg,bmp,png',
            'distance_to_next' => 'numeric',
            'time_to_next' => 'numeric',
            'site_url' => 'string|max:190',
            'montbell_friend_shop' => 'string|max:190',
            'other' => 'string|max:190',
        ];
    }
}
