<?php

namespace App\Http\Controllers;

use App\Contracts\TagContract;
use App\Http\Requests\TagPostRequest;
use App\Http\Requests\TagPutRequest;

class TagController extends Controller
{
    private $repo;

    public function __construct(TagContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/tags",
     *  summary="Get all tags",
     *  description="Get all tags",
     *  operationId="Find all",
     *  tags={"Tags"},
     *  @OA\Response(
     *    response=200,
     *    description="Get tag success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get tag success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="name", type="email", example="example"),
     *              @OA\Property(property="column_space", type="integer", example="0"),
     *              @OA\Property(property="is_keyword", type="integer", example="0"),
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
     *  path="/api/v1/tags/active",
     *  summary="Get all tags active",
     *  description="Get all tags active",
     *  operationId="Find all tags active",
     *  tags={"Tags"},
     *  @OA\Response(
     *    response=200,
     *    description="Get tag success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get tag success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="name", type="email", example="example"),
     *              @OA\Property(property="column_space", type="integer", example="0"),
     *              @OA\Property(property="is_keyword", type="integer", example="1"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *          )
     *       ),
     *    )
     *  )
     * )
     */
    public function listTagsActive()
    {
        return $this->repo->listTagsActive();
    }

    /**
     * @OA\Get(
     *  path="/api/v1/tags/{tag_id}",
     *  summary="Get tag",
     *  description="Get tag by id",
     *  operationId="Find",
     *  tags={"Tags"},
     * @OA\Parameter(
     *     name="tag_id",
     *     in="path",
     *     description="ID of tag to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Get tag success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get tag success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="email", example="example"),
     *                 @OA\Property(property="column_space", type="integer", example="0"),
     *                 @OA\Property(property="is_keyword", type="integer", example="1"),
     *                 @OA\Property(property="created_at", type="string", example=null),
     *                 @OA\Property(property="updated_at", type="string", example=null),
     *        ),
     *      )
     *  ),
     * )
     */
    public function show(\App\Models\Tag $tag)
    {
        return $this->repo->show($tag);
    }

    /**
     * @OA\Post(
     * path="/api/v1/tags",
     * summary="create a tag",
     * description="create a tag",
     * operationId="create",
     * tags={"Tags"},
     * @OA\RequestBody(
     *    required=false,
     *    description="Create tag profile",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="example"),
     *       @OA\Property(property="column_space", type="integer", example="0"),
     *       @OA\Property(property="is_keyword", type="integer", example="1"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert tag success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="insert tag success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="email", example="example"),
     *          @OA\Property(property="column_space", type="integer", example="0"),
     *          @OA\Property(property="is_keyword", type="integer", example="1"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *      )
     * ),
     * )
     */
    public function store(TagPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1/tags/{tag_id}",
     * summary="Update tag",
     * description="Update tag by id",
     * operationId="update",
     * tags={"Tags"},
     * @OA\Parameter(
     *     name="tag_id",
     *     in="path",
     *     description="ID of tag to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=false,
     *    description="Update tag",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="example"),
     *       @OA\Property(property="column_space", type="integer", example="0"),
     *       @OA\Property(property="is_keyword", type="integer", example="1"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update tag success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update tag success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="email", example="example"),
     *          @OA\Property(property="column_space", type="integer", example="0"),
     *          @OA\Property(property="is_keyword", type="integer", example="1"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *      )
     * ),
     * )
     */
    public function update(TagPutRequest $request, \App\Models\Tag $tag)
    {
        return $this->repo->update($request, $tag);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/tags/{tag_id}",
     *  summary="Delete a tag",
     *  description="Delete a tag by id",
     *  operationId="Delete",
     *  tags={"Tags"},
     * @OA\Parameter(
     *     name="tag_id",
     *     in="path",
     *     description="ID of tag to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete tag success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete tag success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="email", example="example"),
     *          @OA\Property(property="column_space", type="integer", example="0"),
     *          @OA\Property(property="is_keyword", type="integer", example="1"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *        )
     *  ),
     * )
     */
    public function destroy(\App\Models\Tag $tag)
    {
        return $this->repo->destroy($tag);
    }
}
