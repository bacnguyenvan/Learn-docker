<?php

namespace App\Http\Requests;

class NotificationPutRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => 'integer',
            'title' => 'string|max:190',
            'content' => 'string',
            'image' => 'file|max:2048|mimes:jpeg,bmp,png',
            'policy' => 'string|max:190',
            'release_time' => 'string',
            'member_ids' => 'string|max:190',
        ];
    }
}
