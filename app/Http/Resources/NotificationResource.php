<?php

namespace App\Http\Resources;

use App\Models\MemberNotification;
use Illuminate\Http\Resources\Json\JsonResource;

/**
* @OA\Schema(
*     properties={
*         @OA\Property(property="status_code", type="integer", example="200"),
*         @OA\Property(property="message", type="string", example="Get all notifications success"),
*         @OA\Property(
*             property="data",
*             type = "object",
*             @OA\Property(property="id", type="integer", example=1),
*             @OA\Property(property="title", type="string", example="Notifications title"),
*             @OA\Property(property="body", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
*             @OA\Property(property="delivery_time", type="string", example="2020-11-28 03:05:06"),
*             @OA\Property(property="member_extract", type="object",
*                 @OA\Property(property="member_id", type="array", example={1,2},
*                     @OA\Items(type="integer"),
*                 ),
*                 @OA\Property(property="prefecture_id", type="array", example={1,2},
*                     @OA\Items(type="integer"),
*                 ),
*                 @OA\Property(property="all_devices", type="integer", example=1),
*             ),
*             @OA\Property(property="created_at", type="string", example="2020-11-27 03:05:06"),
*             @OA\Property(property="updated_at", type="string", example="2020-11-27 03:37:17"),
*             @OA\Property(property="member_notifications", type="array",
*                 @OA\Items(
*                     type = "object",
*                     @OA\Property(property="notification_id", type="integer", example=1),
*                     @OA\Property(property="member_id", type="integer", example=1, description="0: all members | others: member_id matches value"),
*                     @OA\Property(property="status", type="integer", example=0, description="0: unsent | 1: sent | 2: error"),
*                 ),
*             ),
*             @OA\Property(property="is_unsent", type="boolean", example=true),
*         ),
*     }
* )
*/
class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fmt = config('date.full');
        return array_merge(
            parent::toArray($request),
            [
                'member_extract' => $this->getMemberExtract($this->member_extract),
                'is_unsent' => $this->member_notifications->every(
                    fn ($noti, $key) => $noti->status == MemberNotification::STATUS_UNSENT
                ),
                'delivery_time' => $this->delivery_time->format($fmt),
                'created_at' => $this->created_at->format($fmt),
                'updated_at' => $this->updated_at->format($fmt),
            ]
        );
    }

    protected function getMemberExtract(string $str)
    {
        $re = [];
        $conditions = explode('|', $str);
        foreach ($conditions as $cond) {
            [$field, $value] = explode(':', $cond, 2);
            $re[$field] = explode(',', $value);
            $re[$field] = array_map(fn ($x) => (int) $x, $re[$field]);
        }

        if (isset($re['all_devices'])) {
            $re['all_devices'] = reset($re['all_devices']);
        }

        return $re;
    }
}
