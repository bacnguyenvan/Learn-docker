<?php

namespace App\Http\Requests;

class StampPutRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:190',
            'description' => 'string',
            'thumbnail' => 'file|max:2048|mimes:jpeg,bmp,png',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'type' => 'string|max:190',
        ];
    }
}
