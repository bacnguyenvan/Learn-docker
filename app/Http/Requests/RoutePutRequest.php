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
            'number' => 'integer',
            'name' => 'max:255',
            'description' => '',
            'movement' => 'max:100',
            'stamina_level' => 'integer',
            'range' => 'numeric',
            'diff_elevation' => 'numeric',
            'journey_time' => 'integer',
            'line_color' => '',
            'activity_id' => 'integer',
        ];
    }
}
