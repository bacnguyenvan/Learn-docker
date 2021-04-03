<?php

namespace App\Http\Requests;
use App\Rules\PhoneJP;
class LandmarkPostRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'area_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
            'category' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required',
            'tel' => ['nullable', new PhoneJP],
        ];
    }
}
