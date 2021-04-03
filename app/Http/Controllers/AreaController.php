<?php

namespace App\Http\Controllers;

use App\Contracts\AreaContract;

class AreaController extends Controller
{
    private $repo;

    public function __construct(AreaContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\GET(
     *     tags={"Areas"},
     *     summary="Get all areas",
     *     description="Get all areas data",
     *     path="/api/v1/areas",
     * @OA\Response(
     *     response=200,
     *     description="List data",
     *     @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="200"),
     *         @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 format="query",
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="number", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="鳥取（鳥取県）"),
     *                 @OA\Property(property="thumbnail", type="string", example="area/01/img01.jpg"),
     *                 @OA\Property(property="slogan", type="string", example="悠久の時を感じる 名峰大山と日本海の旅路"),
     *                 @OA\Property(property="description", type="string", example="中国地方最高峰の大山を擁し、日本海に面する鳥取県。「大いなる神の在ます山」として信仰される大山周辺には古くから人々が集い、開山1300年の歴史を有する大山寺や、国内最大規模の弥生時代集落跡むきばんだ遺跡など、独自の文化が醸成されました。豊かな山が海を育み、その砂粒が打ち寄せて広大な弓ヶ浜や鳥取砂丘を造り出します。 悠久の時の流れが生んだ雄大な自然をぜひ体感してください。"),
     *                 @OA\Property(property="latitude", type="float", example="35.462900006154165"),
     *                 @OA\Property(property="longitude", type="float", example="133.486161"),
     *                 @OA\Property(property="zoom_level", type="integer", example="18"),
     *                 @OA\Property(property="latitude_in_region", type="float", example="35.462900006154165"),
     *                 @OA\Property(property="longtitude_in_region", type="float", example="133.486161"),
     *                 @OA\Property(property="catalog_file", type="string", example="area/01/areamap01.jpg"),
     *                 @OA\Property(property="map_file", type="string", example="area/pdf/01/jetmap_01.pdf"),
     *                 @OA\Property(
     *                     property="prefecture",
     *                     type="array",
     *                     format="query",
     *                     example={8, 11, 17},
     *                     @OA\Items(type="integer")
     *                 )
     *             )
     *         )
     *     )
     * ),
     * )
     */
    public function index()
    {
        return $this->repo->index();
    }

    /**
     * @OA\Get(
     *     tags={"Areas"},
     *     summary="Get area by id",
     *     description="Get area by id",
     *     path="/api/v1/areas/id",
     * @OA\Parameter(
     *     parameter="id",
     *     in="path",
     *     name="id",
     *     description="ID",
     *     required=true,
     *     @OA\Schema(
     *          type="integer",
     *          example=1
     *      )
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Get area success",
     *     @OA\JsonContent(ref="#/components/schemas/AreaResource")
     * ),
     * )
     */
    public function show(\App\Models\Area $area)
    {
        return $this->repo->show($area);
    }

    public function getRoutesByArea(\App\Models\Area $area)
    {
        return $this->repo->getRoutesByArea($area);
    }

    /**
     * @OA\Post(
     * path="/api/v1/areas",
     * summary="create a area",
     * description="create a area",
     * operationId="create",
     * tags={"Areas"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Update news",
     *    @OA\JsonContent(
     *       required={"prefecture_id","number","name","images","slogan","description","latitude","longitude","latitude_in_region","longtitude_in_region"},
     *       @OA\Property(property="prefecture_id", type="integer", example="10"),
     *       @OA\Property(property="number", type="integer", example="120"),
     *       @OA\Property(property="name", type="string", example="Area"),
     *       @OA\Property(property="images", type="[]", example="[thumbnail file 1, thumbnail file 2]"),
     *       @OA\Property(property="captions", type="[]", example="[cycling caption,trekking caption]"),
     *       @OA\Property(property="slogan", type="string", example="Stay hungry stay foolish"),
     *       @OA\Property(property="description", type="string", example="description"),
     *       @OA\Property(property="latitude", type="float", example="35.462900006154165"),
     *       @OA\Property(property="longitude", type="float", example="133.486161"),
     *       @OA\Property(property="zoom_level", type="integer", example="18"),
     *       @OA\Property(property="latitude_in_region", type="float", example="35.462900006154165"),
     *       @OA\Property(property="longtitude_in_region", type="float", example="133.486161"),
     *       @OA\Property(property="catalog_file", type="string", example=""),
     *       @OA\Property(property="map_file", type="string", example=""),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Insert area success",
     *     @OA\JsonContent(ref="#/components/schemas/AreaResource")
     * ),
     * )
     */
    public function store(\App\Http\Requests\AreaPostRequest $request)
    {
        return $this->repo->store($request);
    }

    
    /**
     * @OA\Post(
     * path="/api/v1/areas/{area_id}",
     * summary="Update area",
     * description="Update area by id",
     * operationId="update",
     * tags={"Areas"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Update news",
     *    @OA\JsonContent(
     *       required={"prefecture_id","number","name","slogan","description","latitude","longtitude","latitude_in_region","longtitude_in_region"},
     *       @OA\Property(property="prefecture_id", type="integer", example="10"),
     *       @OA\Property(property="number", type="integer", example="120"),
     *       @OA\Property(property="name", type="string", example="Area"),
     *       @OA\Property(property="images", type="[]", example="[thumbnail file 1, thumbnail file 2]"),
     *       @OA\Property(property="captions", type="[]", example="[cycling caption,trekking caption]"),
     *       @OA\Property(property="slogan", type="string", example="Stay hungry stay foolish"),
     *       @OA\Property(property="description", type="string", example="description"),
     *       @OA\Property(property="latitude", type="float", example="35.462900006154165"),
     *       @OA\Property(property="longitude", type="float", example="133.486161"),
     *       @OA\Property(property="zoom_level", type="integer", example="18"),
     *       @OA\Property(property="latitude_in_region", type="float", example="35.462900006154165"),
     *       @OA\Property(property="longtitude_in_region", type="float", example="133.486161"),
     *       @OA\Property(property="catalog_file", type="string", example=""),
     *       @OA\Property(property="map_file", type="string", example=""),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Update area success",
     *     @OA\JsonContent(ref="#/components/schemas/AreaResource")
     * ),
     * )
     */
    public function update(\App\Http\Requests\AreaPutRequest $request,\App\Models\Area $area)
    {
        return $this->repo->update($request, $area);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/area/{area_id}",
     *  summary="Delete a area",
     *  description="Delete a area by id",
     *  operationId="Delete",
     *  tags={"Areas"},
     * @OA\Parameter(
     *     name="area_id",
     *     in="path",
     *     description="ID of area to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *     response=200,
     *     description="Delete area success",
     *     @OA\JsonContent(ref="#/components/schemas/AreaResource")
     *  ),
     * )
     */
    public function destroy(\App\Models\Area $area)
    {
        return $this->repo->destroy($area);
    }

    /**
     * @OA\Get(
     *     tags={"Areas"},
     *     summary="Get landmarks by area_id",
     *     description="Get landmarks by area_id",
     *     path="/api/v1/areas/{area_id}/landmarks",
     * @OA\Parameter(
     *     parameter="area_id",
     *     in="path",
     *     name="area_id",
     *     description="ID",
     *     required=true,
     *     @OA\Schema(
     *          type="integer",
     *          example=1
     *      )
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Get landmarks success",
     *     @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="200"),
     *         @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 format="query",
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="area_id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="鳥取（鳥取県）"),
     *                 @OA\Property(property="description", type="string", example="中国地方最高峰の大山を擁し、日本海に面する鳥取県。「大いなる神の在ます山」として信仰される大山周辺には古くから人々が集い、開山1300年の歴史を有する大山寺や、国内最大規模の弥生時代集落跡むきばんだ遺跡など、独自の文化が醸成されました。豊かな山が海を育み、その砂粒が打ち寄せて広大な弓ヶ浜や鳥取砂丘を造り出します。 悠久の時の流れが生んだ雄大な自然をぜひ体感してください。"),
     *                 @OA\Property(property="thumbnail", type="string", example="http://localhost:801/images/landmarks/images/asodaikanbousaten.jpg"),
     *                 @OA\Property(property="support", type="string", example="playground_icon/gas_icon"),
     *                 @OA\Property(property="icon", type="string", example="restaurant"),
     *                 @OA\Property(property="latitude", type="float", example="35.462900006154165"),
     *                 @OA\Property(property="longitude", type="float", example="133.486161"),
     *                 @OA\Property(property="zoom_level", type="integer", example="18"),
     *                 @OA\Property(property="latitude_in_region", type="float", example="35.462900006154165"),
     *                 @OA\Property(property="longtitude_in_region", type="float", example="133.486161"),
     *                 @OA\Property(property="category", type="string", example="None"),
     *                 @OA\Property(property="address", type="string", example="阿蘇市一の宮町宮地154-3"),
     *                 @OA\Property(property="tel", type="string", example="096-722-0111"),
     *                 @OA\Property(property="is_member_benefit", type="integer", example="1"),
     *                 @OA\Property(property="site_url", type="string", example="https://asodora111.stores.jp/"),
     *                 @OA\Property(property="montbell_friend_shop", type="string", example="https://asodora111.stores.jp/")
     *             )
     *         )
     *     )
     * ),
     * )
     */
    public function getLandmarksByArea(\App\Models\Area $area)
    {
        return $this->repo->getLandmarksByArea($area);
    }
}
