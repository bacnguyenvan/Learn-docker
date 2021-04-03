<?php

namespace App\Http\Requests;

class AdminPutRequest extends APIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:admins,email,'.$this->admin->id,
            'name' => 'required',
            'level' => 'required|numeric'
        ];
    }
}
