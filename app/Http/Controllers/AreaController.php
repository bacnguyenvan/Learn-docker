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
     *     summary="Get all areas by prefecture",
     *     description="Get all areas by a prefecture id",
     *     path="/api/v1/areas/{prefecture_id}",
     * @OA\Parameter(
     *     parameter="prefecture_id",
     *     in="path",
     *     name="prefecture_id",
     *     description="Prefecture ID",
     *     required=true,
     *     @OA\Schema(
     *          type="integer",
     *          example=1
     *      )
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Get area success",
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
     *                 @OA\Property(property="catalog_file", type="string", example="area/01/areamap01.jpg"),
     *                 @OA\Property(property="map_file", type="string", example="area/pdf/01/jetmap_01.pdf")
     *             )
     *         )
     *     )
     * ),
     * )
     */
    /**
     * Prefecture
     */
    // public function show($id)
    // {
    //     return $this->repo->show($id);
    // }

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
     * @OA\Parameter(
     *     name="prefecture_id",
     *     in="path",
     *     description="prefecture ID of area. Area has many prefecture",
     *     required=true,
     *     @OA\Schema(
     *         type="int",
     *         example=100
     *     ),
     * ),
     * @OA\Parameter(
     *     name="number",
     *     in="path",
     *     description="Area number",
     *     required=true,
     *     @OA\Schema(
     *         type="int",
     *         example=100
     *     ),
     * ),
     * @OA\Parameter(
     *     name="name",
     *     in="path",
     *     description="Area name",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="Area a"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="thumbnail",
     *     in="path",
     *     description="Area thumbnail",
     *     required=true,
     *     @OA\Schema(
     *         type="file",
     *         example="areas/thumbnail/1.jpg"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="slogan",
     *     in="path",
     *     description="Area slogan",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="Stay hungry stay foolish"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="description",
     *     in="path",
     *     description="Area description",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="Stay hungry stay foolish description"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="latitude",
     *     in="path",
     *     description="Area latitude",
     *     required=true,
     *     @OA\Schema(
     *         type="double",
     *         example=32.691429
     *     ),
     * ),
     * @OA\Parameter(
     *     name="longtitude",
     *     required=true,
     *     in="path",
     *     description="Area longtitude",
     *     @OA\Schema(
     *         type="double",
     *         example=32.691429
     *     ),
     * ),
     * @OA\Parameter(
     *     name="zoom_level",
     *     in="path",
     *     description="Area zoom_level of map",
     *     @OA\Schema(
     *         type="int",
     *         example=15
     *     ),
     * ),
     * @OA\Parameter(
     *     name="catalog_file",
     *     in="path",
     *     description="Area catalog_file",
     *     @OA\Schema(
     *         type="string",
     *         example="xx"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="map_file",
     *     in="path",
     *     description="Area map_file",
     *     @OA\Schema(
     *         type="string",
     *         example="xx"
     *     ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert area success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="insert area success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="email", example="example"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *      )
     * ),
     * )
     */
    public function store(\App\Http\Requests\AreaPostRequest $request)
    {
        return $this->repo->store($request);
    }

    
    /**
     * @OA\Put(
     * path="/api/v1/areas/{area_id}",
     * summary="Update area",
     * description="Update area by id",
     * operationId="update",
     * tags={"Areas"},
     * @OA\Parameter(
     *     name="prefecture_id",
     *     in="path",
     *     description="prefecture ID of area. Area has many prefecture",
     *     required=true,
     *     @OA\Schema(
     *         type="int",
     *         example=100
     *     ),
     * ),
     * @OA\Parameter(
     *     name="number",
     *     in="path",
     *     description="Area number",
     *     required=true,
     *     @OA\Schema(
     *         type="int",
     *         example=100
     *     ),
     * ),
     * @OA\Parameter(
     *     name="name",
     *     in="path",
     *     description="Area name",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="Area a"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="thumbnail",
     *     in="path",
     *     description="Area thumbnail",
     *     required=true,
     *     @OA\Schema(
     *         type="file",
     *         example="areas/thumbnail/1.jpg"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="slogan",
     *     in="path",
     *     description="Area slogan",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="Stay hungry stay foolish"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="description",
     *     in="path",
     *     description="Area description",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="Stay hungry stay foolish description"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="latitude",
     *     in="path",
     *     description="Area latitude",
     *     required=true,
     *     @OA\Schema(
     *         type="double",
     *         example=32.691429
     *     ),
     * ),
     * @OA\Parameter(
     *     name="longtitude",
     *     required=true,
     *     in="path",
     *     description="Area longtitude",
     *     @OA\Schema(
     *         type="double",
     *         example=32.691429
     *     ),
     * ),
     * @OA\Parameter(
     *     name="zoom_level",
     *     in="path",
     *     description="Area zoom_level of map",
     *     @OA\Schema(
     *         type="int",
     *         example=15
     *     ),
     * ),
     * @OA\Parameter(
     *     name="catalog_file",
     *     in="path",
     *     description="Area catalog_file",
     *     @OA\Schema(
     *         type="string",
     *         example="xx"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="map_file",
     *     in="path",
     *     description="Area map_file",
     *     @OA\Schema(
     *         type="string",
     *         example="xx"
     *     ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update area success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update area success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="email", example="example"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *      )
     * ),
     * )
     */
    public function update(\App\Http\Requests\AreaPostRequest $request,\App\Models\Area $area)
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
     *    response=200,
     *    description="Delete area success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete area success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="email", example="example"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *        )
     *  ),
     * )
     */
    public function destroy(\App\Models\Area $area)
    {
        return $this->repo->destroy($area);
    }
}
