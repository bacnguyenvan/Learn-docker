<?php

namespace App\Http\Requests;

class AppInfoPostRequest extends APIRequest
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
            'version' => 'required|string|max:190'
        ];
    }
}
