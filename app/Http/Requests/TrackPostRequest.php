<?php

namespace App\Http\Requests;

class TrackPostRequest extends APIRequest
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
            'name' => 'required|max:190',
            'description' => 'required',
            'type' => 'required|max:100'
        ];
    }
}
