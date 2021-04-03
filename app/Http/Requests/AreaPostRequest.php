<?php

namespace App\Http\Requests;

class AreaPostRequest extends APIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prefecture_id' => 'required|array',
            'prefecture_id.*' => 'required|integer',
            'number' => 'required|integer',
            'name' => 'required',
            'slogan' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longtitude' => 'required',
            'images' => 'required',
            'images.*' => 'file|mimes:jpeg,png,jpg|max:2048',
            'latitude_in_region' => 'required',
            'longtitude_in_region' => 'required',
        ];
    }
}
