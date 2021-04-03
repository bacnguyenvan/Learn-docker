<?php

namespace App\Http\Requests;

class TrackPointPutRequest extends APIRequest
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
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'elevation' => 'numeric',
            'data' => ''
        ];
    }
}
