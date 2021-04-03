<?php

namespace App\Http\Requests;

class AuthPostLoginRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'type' => 'required',
            'device_token' => 'required',
            'device_agent' => 'nullable',
        ];
    }
}
