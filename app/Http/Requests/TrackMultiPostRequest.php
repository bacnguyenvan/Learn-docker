<?php

namespace App\Http\Requests;

class TrackMultiPostRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required',
            'member_id' => 'required|max:190',
            'name' => 'required|max:190',
            'description' => 'required',
            'type' => 'required|max:100'
        ];
    }
}
