<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'member_id' => $this->member_id,
            'notification_id' => $this->notification_id,
            'read_at' => $this->read_at,
            'unread_count' => $this->unread_count,
            'title' => $this->notification->title,
            'content' => $this->notification->content,
            'image' => $this->notification->image,
            'policy' => $this->notification->policy,
            'type' => $this->notification->notificationTypes->name
        ];
    }
}
