<?php

namespace App\Http\Controllers;

use App\Contracts\StampContract;
use App\Http\Requests\StampPostRequest;
use App\Http\Requests\StampPutRequest;

class StampController extends Controller
{
    private $repo;

    public function __construct(StampContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/stamps",
     *  summary="Get all stamps",
     *  description="Get all stamps",
     *  operationId="Find all",
     *  tags={"Stamps"},
     *  @OA\Response(
     *    response=200,
     *    description="Get stamp success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get stamp success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/images/stamps/stamp_boat.png"),
     *              @OA\Property(property="type", type="string", example="boat"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
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
     *  path="/api/v1/stamps/{stamp_id}",
     *  summary="Get stamp",
     *  description="Get stamp by id",
     *  operationId="Find",
     *  tags={"Stamps"},
     * @OA\Parameter(
     *     name="stamp_id",
     *     in="path",
     *     description="ID of stamp to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Get stamp success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get stamp success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/images/stamps/stamp_boat.png"),
     *              @OA\Property(property="type", type="string", example="boat"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *        ),
     *      )
     *  ),
     * )
     */
    public function show(\App\Models\Stamp $stamp)
    {
        return $this->repo->show($stamp);
    }

    /**
     * @OA\Post(
     * path="/api/v1/stamps",
     * summary="create a stamp",
     * description="create a stamp",
     * operationId="create",
     * tags={"Stamps"},
     * @OA\RequestBody(
     *    required=false,
     *    description="Create stamp profile",
     *    @OA\JsonContent(
     *       required={"latitude", "longitude", "type"},
     *       @OA\Property(property="name", type="string", example="tempore"),
     *       @OA\Property(property="description", type="string", example="et"),
     *       @OA\Property(property="latitude", type="float", example=-36.707632),
     *       @OA\Property(property="longitude", type="float", example=112.739408),
     *       @OA\Property(property="type", type="string", example="skiing (dropdown with list: skiing/snowshoes/climb/climb-bycicle/climb-bycicle-boat/bycicle/climb-boat/bycicle-boat/boat)"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert stamp success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="insert stamp success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/images/stamps/stamp_boat.png"),
     *              @OA\Property(property="type", type="string", example="boat"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *      )
     * ),
     * )
     */
    public function store(StampPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1/stamps/{stamp_id}",
     * summary="Update stamp",
     * description="Update stamp by id",
     * operationId="update",
     * tags={"Stamps"},
     * @OA\Parameter(
     *     name="stamp_id",
     *     in="path",
     *     description="ID of stamp to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=false,
     *    description="Update stamp",
     *    @OA\JsonContent(
     *       required={"latitude", "longitude", "type"},
     *       @OA\Property(property="name", type="string", example="tempore"),
     *       @OA\Property(property="description", type="string", example="et"),
     *       @OA\Property(property="latitude", type="float", example=-36.707632),
     *       @OA\Property(property="longitude", type="float", example=112.739408),
     *       @OA\Property(property="type", type="string", example="boat ( dropdown: skiing/snowshoes/climb/climb-bycicle/climb-bycicle-boat/bycicle/climb-boat/bycicle-boat/boat)"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update stamp success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update stamp success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/images/stamps/stamp_boat.png"),
     *              @OA\Property(property="type", type="string", example="boat"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *      )
     * ),
     * )
     */
    public function update(StampPostRequest $request, \App\Models\Stamp $stamp)
    {
        return $this->repo->update($request, $stamp);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/stamps/{stamp_id}",
     *  summary="Delete a stamp",
     *  description="Delete a stamp by id",
     *  operationId="Delete",
     *  tags={"Stamps"},
     * @OA\Parameter(
     *     name="stamp_id",
     *     in="path",
     *     description="ID of stamp to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete stamp success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete stamp success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/images/stamps/stamp_boat.png"),
     *              @OA\Property(property="type", type="string", example="boat"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *        )
     *  ),
     * )
     */
    public function destroy(\App\Models\Stamp $stamp)
    {
        return $this->repo->destroy($stamp);
    }
}
