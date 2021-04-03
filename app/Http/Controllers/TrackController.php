<?php

namespace App\Http\Controllers;

use App\Contracts\TrackContract;
use App\Http\Requests\TrackMultiPostRequest;
use \App\Http\Requests\TrackPostRequest;
use \App\Http\Requests\TrackPutRequest;

class TrackController extends Controller
{
    private $repo;

    public function __construct(TrackContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/tracks",
     *  summary="Get all tracks",
     *  description="Get all tracks",
     *  operationId="Get all",
     *  tags={"Tracks"},
     *  @OA\Response(
     *    response=200,
     *    description="Get all track success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get all track success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="route_id", type="integer", example=34),
     *              @OA\Property(property="member_id", type="integer", example=3),
     *              @OA\Property(property="name", type="string", example="Antoinette Effertz"),
     *              @OA\Property(property="description", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *              @OA\Property(property="type", type="string", example="et"),
     *              @OA\Property(property="total_time", type="float", format="string", example=10.5),
     *              @OA\Property(property="total_distance", type="float", format="string", example=100),
     *              @OA\Property(property="max_elevation", type="float", format="string", example=1000),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *          )
     *       ),
     *        )
     *  )
     * )
     */
    public function index()
    {
        return $this->repo->index();
    }

    /**
     * @OA\Get(
     *  path="/api/v1/tracks/{track_id}",
     *  summary="Get a track info by id",
     *  description="Get a track info by id",
     *  operationId="Find",
     *  tags={"Tracks"},
     * @OA\Parameter(
     *     name="track_id",
     *     in="path",
     *     description="ID of track to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Find track success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Find track success"),
     *       @OA\Property(
     *              property="data",
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="route_id", type="integer", example=34),
     *              @OA\Property(property="member_id", type="integer", example=3),
     *              @OA\Property(property="name", type="string", example="Antoinette Effertz"),
     *              @OA\Property(property="description", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *              @OA\Property(property="type", type="string", example="et"),
     *              @OA\Property(property="total_time", type="float", format="string", example=10.5),
     *              @OA\Property(property="total_distance", type="float", format="string", example=100),
     *              @OA\Property(property="max_elevation", type="float", format="string", example=1000),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *          )
     *        )
     *  )
     * )
     */
    public function show(\App\Models\Track $track)
    {
        return $this->repo->show($track);
    }

    /**
     * @OA\Post(
     * path="/api/v1/tracks",
     * summary="Create a track",
     * description="Create a new track",
     * operationId="Insert",
     * tags={"Tracks"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Create a track",
     *    @OA\JsonContent(
     *       required={"route_id","member_id","name","description","type","total_time", "total_distance", "max_elevation"},
     *       @OA\Property(property="route_id", type="number", format="email", example=1),
     *       @OA\Property(property="member_id", type="number", format="boolean", example=1),
     *       @OA\Property(property="name", type="string", format="string", example="Antoinette Effertz"),
     *       @OA\Property(property="description", type="text", format="", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *       @OA\Property(property="total_time", type="float", format="string", example=10.5),
     *       @OA\Property(property="total_distance", type="float", format="string", example=100),
     *       @OA\Property(property="max_elevation", type="float", format="string", example=1000),
     *       @OA\Property(property="type", type="string", format="string", example="drive"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert track success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Insert track success"),
     *       @OA\Property(
     *              property="data",
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="route_id", type="integer", example=1),
     *              @OA\Property(property="member_id", type="integer", example=1),
     *              @OA\Property(property="name", type="string", example="Antoinette Effertz"),
     *              @OA\Property(property="description", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *              @OA\Property(property="type", type="string", example="drive"),
     *              @OA\Property(property="total_time", type="float", format="string", example=10.5),
     *              @OA\Property(property="total_distance", type="float", format="string", example=100),
     *              @OA\Property(property="max_elevation", type="float", format="string", example=1000),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *          )
     *        )
     *     )
     * )
     */
    public function store(TrackPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1/tracks/{track_id}",
     * summary="Update a track info by id",
     * description="Update a track info by id",
     * operationId="Update",
     * tags={"Tracks"},
     * @OA\Parameter(
     *     name="track_id",
     *     in="path",
     *     description="ID of track to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Update track",
     *    @OA\JsonContent(
     *       @OA\Property(property="route_id", type="number", format="email", example=1),
     *       @OA\Property(property="member_id", type="number", format="boolean", example=1),
     *       @OA\Property(property="name", type="string", format="string", example="Antoinette Effertz"),
     *       @OA\Property(property="description", type="text", format="", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *       @OA\Property(property="type", type="string", format="string", example="drive"),
     *       @OA\Property(property="total_time", type="float", format="string", example=10.5),
     *       @OA\Property(property="total_distance", type="float", format="string", example=100),
     *       @OA\Property(property="max_elevation", type="float", format="string", example=1000),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update track success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update track success"),
     *       @OA\Property(
     *              property="data",
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="route_id", type="integer", example=1),
     *              @OA\Property(property="member_id", type="integer", example=1),
     *              @OA\Property(property="name", type="string", example="Antoinette Effertz"),
     *              @OA\Property(property="description", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *              @OA\Property(property="type", type="string", example="drive"),
     *              @OA\Property(property="total_time", type="float", format="string", example=10.5),
     *              @OA\Property(property="total_distance", type="float", format="string", example=100),
     *              @OA\Property(property="max_elevation", type="float", format="string", example=1000),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *          )
     *        )
     *     )
     * )
     */
    public function update(TrackPutRequest $request, \App\Models\Track $track)
    {
        return $this->repo->update($request, $track);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/tracks/{track_id}",
     *  summary="Delete a track",
     *  description="Delete a track by id",
     *  operationId="Delete",
     *  tags={"Tracks"},
     * @OA\Parameter(
     *     name="track_id",
     *     in="path",
     *     description="ID of track to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete track success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete track success"),
     *       @OA\Property(
     *              property="data",
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="route_id", type="integer", example=34),
     *              @OA\Property(property="member_id", type="integer", example=3),
     *              @OA\Property(property="name", type="string", example="Antoinette Effertz"),
     *              @OA\Property(property="description", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *              @OA\Property(property="type", type="string", example="et"),
     *              @OA\Property(property="total_time", type="float", format="string", example=10.5),
     *              @OA\Property(property="total_distance", type="float", format="string", example=100),
     *              @OA\Property(property="max_elevation", type="float", format="string", example=1000),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *          )
     *        )
     *  )
     * )
     */
    public function destroy(\App\Models\Track $track)
    {
        return $this->repo->destroy($track);
    }

    public function storeMulti(TrackMultiPostRequest $request)
    {
        return $this->repo->storeMulti($request);
    }
}
