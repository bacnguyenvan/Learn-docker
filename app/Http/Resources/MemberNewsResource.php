<?php

namespace App\Http\Resources;

use App\Http\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
* @OA\Schema(
*     properties={
*         @OA\Property(property="status_code", type="integer", example="200"),
*         @OA\Property(property="message", type="string", example="Get news list success"),
*         @OA\Property(
*            property="data",
*            type="array",
*            @OA\Items(
*                type="object",
*                @OA\Property(property="id", type="number", example=1),
*                @OA\Property(property="member_id", type="number", example=1),
*                @OA\Property(property="news_id", type="text", example=1),
*                @OA\Property(property="title", type="string", example="News 9"),
*                @OA\Property(property="content", type="string", example="content"),
*                @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/400x300.jpg"),
*                @OA\Property(property="policy", type="string", example="policy"),
*                @OA\Property(property="is_new", type="boolean", example=true),
*                @OA\Property(property="is_public", type="boolean", example=true),
*                @OA\Property(property="is_read", type="boolean", example=false),
*                @OA\Property(property="release_time", type="string", example="2021-03-18 08:08:02"),
*                @OA\Property(property="created_at", type="string", example="2021-03-18 08:08:02"),
*                @OA\Property(property="updated_at", type="string", example="2021-03-18 08:08:02"),
*            )
*         )
*     }
* )
*/
class MemberNewsResource extends JsonResource
{
    const IS_NEW_PERIOD = 14; // days

    protected function isNew(Carbon $release_time)
    {
        $d = $release_time->toImmutable();
        return now()->betweenIncluded($d, $d->addDays(self::IS_NEW_PERIOD));
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fmt = config('date.full');
        $urlApp = Helper::getUrlApplication();

        return [
            'id' => $this->id ?? null,
            'member_id' => $this->member_id,
            'news_id' => $this->news_id,
            'title' => $this->title,
            'content' => $this->content,
            'thumbnail' => $urlApp.'/'.$this->thumbnail,
            'is_read' => $this->member_id != null,
            'is_public' => $this->is_public,
            'is_new' => $this->isNew($this->release_time),
            'policy' => $this->policy,
            'release_time' => $this->release_time->format($fmt),
            'created_at' => $this->created_at->format($fmt),
            'updated_at' => $this->updated_at->format($fmt),
        ];
    }
}
