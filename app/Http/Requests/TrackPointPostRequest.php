<?php

namespace App\Http\Requests;

class TrackPointPostRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'track_id' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'elevation' => 'required|numeric',
            'data' => 'required'
        ];
    }
}
