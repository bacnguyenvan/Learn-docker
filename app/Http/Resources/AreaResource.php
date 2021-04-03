<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
* @OA\Schema(
*     properties={
*         @OA\Property(property="status_code", type="integer", example="200"),
*         @OA\Property(property="message", type="string", example="Get areas success"),
*         @OA\Property(
*             property="data",
*             type="object",
*             @OA\Property(property="id", type="integer", example="1"),
*             @OA\Property(property="number", type="integer", example="1"),
*             @OA\Property(property="name", type="string", example="鳥取（鳥取県）"),
*             @OA\Property(property="thumbnail", type="string", example="area/01/img01.jpg"),
*             @OA\Property(property="slogan", type="string", example="悠久の時を感じる 名峰大山と日本海の旅路"),
*             @OA\Property(property="description", type="string", example="中国地方最高峰の大山を擁し、日本海に面する鳥取県。「大いなる神の在ます山」として信仰される大山周辺には古くから人々が集い、開山1300年の歴史を有する大山寺や、国内最大規模の弥生時代集落跡むきばんだ遺跡など、独自の文化が醸成されました。豊かな山が海を育み、その砂粒が打ち寄せて広大な弓ヶ浜や鳥取砂丘を造り出します。 悠久の時の流れが生んだ雄大な自然をぜひ体感してください。"),
*             @OA\Property(property="latitude", type="float", example="35.462900006154165"),
*             @OA\Property(property="longitude", type="float", example="133.486161"),
*             @OA\Property(property="zoom_level", type="integer", example="18"),
*             @OA\Property(property="latitude_in_region", type="float", example="35.462900006154165"),
*             @OA\Property(property="longtitude_in_region", type="float", example="133.486161"),
*             @OA\Property(property="catalog_file", type="string", example="area/01/areamap01.jpg"),
*             @OA\Property(property="map_file", type="string", example="area/pdf/01/jetmap_01.pdf"),
*             @OA\Property(
*                 property="prefecture",
*                 type="array",
*                 format="query",
*                 example={8, 11, 17},
*                 @OA\Items(type="integer")
*             )
*         )
*     }
* )
*/
class AreaResource extends JsonResource
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
            'number' => $this->number,
            'name' => $this->name,
            'slogan' => $this->slogan,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longtitude' => $this->longtitude,
            'zoom_level' => $this->zoom_level??14,
            'latitude_in_region' => $this->latitude_in_region,
            'longtitude_in_region' => $this->longtitude_in_region,
            'catalog_file' => $this->catalog_file,
            'map_file' => $this->map_file,
            'prefectures' => PrefectureResource::collection($this->prefectures),
            'photos' => AreaPhotoResource::collection($this->photos),
            'center_pointer' => $this->center_pointer
        ];
    }
}
