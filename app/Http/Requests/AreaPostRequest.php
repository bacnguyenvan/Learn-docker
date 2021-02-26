<?php

namespace App\Http\Requests;

class AreaPostRequest extends APIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword' => '',
        ];
    }
}
