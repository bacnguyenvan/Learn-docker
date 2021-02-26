<?php

namespace App\Http\Requests;

class PointPostRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'area_id' => 'required|integer',
            'support_id' => 'integer',
            'name' => 'required|string|max:190',
            'number' => 'required|integer',
            'index' => 'integer|integer',
            'title' =>  'required|string|max:190',
            'description' =>  'required|string',
            'address' => 'required|string|max:190',
            'tel' => 'required|string|max:190',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'elevation' => 'required|numeric',
            'thumbnail' => 'required|file|max:2048|mimes:jpeg,bmp,png',
            'distance_to_next' => 'required|numeric',
            'time_to_next' => 'required|numeric',
            'site_url' => 'required|string|max:190',
            'montbell_friend_shop' => 'string|max:190',
            'other' => 'string|max:190',
        ];
    }
}
