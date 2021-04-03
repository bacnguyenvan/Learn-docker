<?php

namespace App\Http\Requests;

class AdminPostRequest extends APIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:admins,email',
            'name' => 'required',
            'password' => 'required',
            'level' => 'required|numeric'
        ];
    }
}
