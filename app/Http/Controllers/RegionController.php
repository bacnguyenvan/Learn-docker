<?php

namespace App\Http\Controllers;

use App\Contracts\RegionContract;

class RegionController extends Controller
{
    private $repo;

    public function __construct(RegionContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/regions",
     *  summary="Get all regions",
     *  description="Get all regions",
     *  operationId="index",
     *  tags={"Regions"},
     *  @OA\Response(
     *    response=200,
     *    description="Get region success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get region success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="name", type="email", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *          )
     *       ),
     *    )
     *  )
     * )
     */
    public function index()
    {
        return $this->repo->index();
    }

    /**
     * @OA\Get(
     *  path="/api/v1/regions/{region_id}",
     *  summary="Get region",
     *  description="Get region by id",
     *  operationId="Find",
     *  tags={"Regions"},
     * @OA\Parameter(
     *     name="region_id",
     *     in="path",
     *     description="ID of region to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Get region success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get region success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="email", example="example"),
     *                 @OA\Property(property="created_at", type="string", example=null),
     *                 @OA\Property(property="updated_at", type="string", example=null),
     *        ),
     *      )
     *  ),
     * )
     */
    public function show(\App\Models\Region $region)
    {
        return $this->repo->show($region);
    }

    /**
     * @OA\Post(
     * path="/api/v1/regions",
     * summary="create a region",
     * description="create a region",
     * operationId="create",
     * tags={"Regions"},
     * @OA\RequestBody(
     *    required=false,
     *    description="Create region profile",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="example"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert region success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="insert region success"),
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
    public function store(\App\Http\Requests\RegionPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1/regions/{region_id}",
     * summary="Update region",
     * description="Update region by id",
     * operationId="update",
     * tags={"Regions"},
     * @OA\Parameter(
     *     name="region_id",
     *     in="path",
     *     description="ID of region to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=false,
     *    description="Update region",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="example"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update region success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update region success"),
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
    public function update(\App\Http\Requests\RegionPutRequest $request, \App\Models\Region $region)
    {
        return $this->repo->update($request, $region);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/regions/{region_id}",
     *  summary="Delete a region",
     *  description="Delete a region by id",
     *  operationId="Delete",
     *  tags={"Regions"},
     * @OA\Parameter(
     *     name="region_id",
     *     in="path",
     *     description="ID of region to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete region success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete region success"),
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
    public function destroy(\App\Models\Region $region)
    {
        return $this->repo->destroy($region);
    }

    /**
     * @OA\Get(
     *     summary="Get all areas by region",
     *     description="Get all areas by a prefecture id",
     *     path="/api/v1/regions/{prefecture_id}/areas",
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
    public function getAreasByRegion($region)
    {
        return $this->repo->getAreasByRegion($region);
    }
}
