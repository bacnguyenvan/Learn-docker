<?php

namespace App\Http\Requests;

class MemberPutRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address' => 'max:190',
            'dob' => 'date_format:Y-m-d',
            'sex' => 'max:10',
            'photo' => 'file|max:2048|mimes:jpeg,bmp,png'
            // 'photo' => '',
        ];
    }
}
