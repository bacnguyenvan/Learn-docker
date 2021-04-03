<?php

namespace App\Http\Requests;

use App\Rules\PhoneJP;

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
            'name' => 'required|string|max:190',
            'number' => 'required|integer',
            'description' =>  'required',
            'address' => 'required',
            'tel' => ['nullable', new PhoneJP],
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ];
    }
}
