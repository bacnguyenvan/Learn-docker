<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;

class NewsPutRequest extends APIRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $h = app(Helper::class);
        $this->merge([
            'is_public' => $h->str2Bool($this->is_public),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:190',
            'content' => 'required',
            'is_public' => 'boolean',
            'policy' => 'nullable|string|max:190',
            'thumbnail' => 'nullable|file|max:2048|mimes:jpeg,jpg,png',
            'release_time' => "required|date",
        ];
    }
}
