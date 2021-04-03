<?php

namespace App\Http\Requests;

/**
* @OA\Schema(
*     required={"title","body","delivery_time"},
*     properties={
*         @OA\Property(property="title", type="string", example="First notification"),
*         @OA\Property(property="body", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."),
*         @OA\Property(property="delivery_time", type="string", example="2020-11-27 03:37:17"),
*         @OA\Property(property="all_devices", type="integer", example=1, description="- 0: No, 1: Yes"),
*         @OA\Property(property="member_id", type="array", example={1,2},
*             @OA\Items(type="integer"),
*         ),
*         @OA\Property(property="prefecture_id", type="array", example={1,2},
*             @OA\Items(type="integer"),
*         ),
*     }
* )
*/
class NotificationUpdateRequest extends NotificationRequestAbstract
{
}
