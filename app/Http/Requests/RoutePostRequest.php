<?php

namespace App\Http\Requests;

class RoutePostRequest extends APIRequest
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
            'movement' => 'required|max:100',
            'stamina_level' => 'required|integer',
            'range' => 'required|numeric',
            'diff_elevation' => 'required|numeric',
            'journey_time' => 'required|integer',
            'line_color' => 'required',
            'activity_id' => 'integer',
        ];
    }
}
