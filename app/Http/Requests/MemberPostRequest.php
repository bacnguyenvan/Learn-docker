<?php

namespace App\Http\Requests;

class MemberPostRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email|required',
            'is_montbell' => 'boolean',
            'address' => 'max:190',
            'dob' => 'date',
            'sex' => 'max:10',
            'password' => 'required',
            'photo' => 'file|max:2048|mimes:jpeg,bmp,png'
            // 'photo' => '',
        ];
    }
}
