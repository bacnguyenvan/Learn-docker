<?php

namespace App\Http\Requests;

class NotificationPostRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => 'required|integer',
            'title' => 'required|string|max:190',
            'content' => 'required|string',
            'image' => 'required|file|max:2048|mimes:jpeg,bmp,png',
            'policy' => 'required|string|max:190',
            'release_time' => 'required|string',
            'member_ids' => 'required|string|max:190',
        ];
    }
}
