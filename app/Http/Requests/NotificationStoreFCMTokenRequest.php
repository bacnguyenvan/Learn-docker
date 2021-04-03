<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* @OA\Schema(
*     required={"device_token","fcm_token"},
*     properties={
*         @OA\Property(property="device_token", type="string", example="AHWR3LRhNIiotrpfJtK1"),
*         @OA\Property(property="device_agent", type="string", example="Mozilla/5.0 (Windows 95) AppleWebKit/5322 (KHTML, like Gecko) Chrome/39.0.866.0 Mobile Safari/5322"),
*         @OA\Property(property="fcm_token", type="string", example="I9o6m6L8FKY1z5PgChtvylcHt91t3NWK6t6wXQal"),
*     }
* )
*/
class NotificationStoreFCMTokenRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'device_token' => 'required',
            'fcm_token' => 'required',
            'device_agent' => 'nullable',
        ];
    }
}
