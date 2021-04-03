<?php

namespace App\Http\Requests;

class TrackPutRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'route_id' => 'required|numeric',
            'member_id' => 'required|numeric',
            'name' => 'max:190',
            'description' => '',
            'type' => 'max:100'
        ];
    }
}
