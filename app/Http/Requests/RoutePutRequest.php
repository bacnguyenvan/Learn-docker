<?php

namespace App\Http\Requests;

class RoutePutRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'area_id' => 'required|integer',
            'number' => 'required|integer',
            'name' => 'required|max:255',
            'description' => 'required',
            'stamina_level' => 'required|integer',
            'range' => 'required|numeric',
            'total_elevation' => 'required|numeric',
            'journey_time' => 'required|integer',
            'line_color' => 'required',
            'geometry' => 'required',
            'point_center' => 'required',
        ];
    }
}
