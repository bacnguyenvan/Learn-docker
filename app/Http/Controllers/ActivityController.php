<?php

namespace App\Http\Controllers;

use App\Contracts\ActivityContract;

class ActivityController extends Controller
{
    private $repo;

    public function __construct(ActivityContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/activities",
     *  summary="Get all activities",
     *  description="Get all activities",
     *  operationId="index",
     *  tags={"Activities"},
     *  @OA\Response(
     *    response=200,
     *    description="Get activity success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get activity success"),
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
     *  path="/api/v1/activities/{activity_id}",
     *  summary="Get activity",
     *  description="Get activity by id",
     *  operationId="Find",
     *  tags={"Activities"},
     * @OA\Parameter(
     *     name="activity_id",
     *     in="path",
     *     description="ID of activity to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Get activity success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get activity success"),
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
    public function show(\App\Models\Activity $activity)
    {
        return $this->repo->show($activity);
    }

    /**
     * @OA\Post(
     * path="/api/v1/activities",
     * summary="create a activity",
     * description="create a activity",
     * operationId="create",
     * tags={"Activities"},
     * @OA\RequestBody(
     *    required=false,
     *    description="Create activity profile",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="example"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert activity success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="insert activity success"),
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
    public function store(\App\Http\Requests\ActivityPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1/activities/{activity_id}",
     * summary="Update activity",
     * description="Update activity by id",
     * operationId="update",
     * tags={"Activities"},
     * @OA\Parameter(
     *     name="activity_id",
     *     in="path",
     *     description="ID of pet to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=false,
     *    description="Update activity",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="example"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update activity success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update activity success"),
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
    public function update(\App\Http\Requests\ActivityPutRequest $request, \App\Models\Activity $activity)
    {
        return $this->repo->update($request, $activity);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/activities/{activity_id}",
     *  summary="Delete a activity",
     *  description="Delete a activity by id",
     *  operationId="Delete",
     *  tags={"Activities"},
     * @OA\Parameter(
     *     name="activity_id",
     *     in="path",
     *     description="ID of activity to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete activity success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete activity success"),
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
    public function destroy(\App\Models\Activity $activity)
    {
        return $this->repo->destroy($activity);
    }
}
