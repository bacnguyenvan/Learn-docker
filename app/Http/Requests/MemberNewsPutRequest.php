<?php

namespace App\Http\Requests;

class MemberNewsPutRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'read_at' => '',
        ];
    }
}
