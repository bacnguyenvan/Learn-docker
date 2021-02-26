<?php

namespace App\Http\Requests;

class StampPostRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:190',
            'description' => 'required|string',
            'thumbnail' => 'required|file|max:2048|mimes:jpeg,bmp,png',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'type' => 'string|max:190',
        ];
    }
}
