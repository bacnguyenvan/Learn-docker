<?php

namespace App\Http\Controllers;

use App\Contracts\NewsContract;
use \App\Http\Requests\NewsPostRequest;
use \App\Http\Requests\NewsPutRequest;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $repo;

    public function __construct(NewsContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/news",
     *  summary="Get all news",
     *  description="Get all news",
     *  operationId="Get all",
     *  tags={"News"},
     *  @OA\Parameter(
     *      name="order_by",
     *      in="query",
     *      description="Sort order. Default to release_time descending if not set.",
     *      @OA\Schema(
     *          type="string",
     *          example="release_time,desc"
     *      )
     *  ),
     *  @OA\Parameter(
     *      name="limit",
     *      in="query",
     *      description="Max items to return. Default to paging if not set.",
     *      @OA\Schema(
     *          type="string",
     *          format="int",
     *          example=5
     *      )
     *  ),
     *  @OA\Parameter(
     *      name="page",
     *      in="query",
     *      description="Page number to return",
     *      @OA\Schema(
     *          type="string",
     *          format="int",
     *          example=1
     *      )
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Get all news success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get all news success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="member_id", type="number", example=1),
     *              @OA\Property(property="news_id", type="text", example=1),
     *              @OA\Property(property="title", type="string", example="News 9"),
     *              @OA\Property(property="content", type="string", example="content"),
     *              @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/400x300.jpg"),
     *              @OA\Property(property="policy", type="string", example="policy"),
     *              @OA\Property(property="is_new", type="boolean", example=true),
     *              @OA\Property(property="is_public", type="boolean", example=true),
     *              @OA\Property(property="is_read", type="boolean", example=false),
     *              @OA\Property(property="release_time", type="string", example="2021-03-18 08:08:02"),
     *              @OA\Property(property="created_at", type="string", example="2021-03-18 08:08:02"),
     *              @OA\Property(property="updated_at", type="string", example="2021-03-18 08:08:02"),
     *          )
     *       ),
     *       @OA\Property(
     *          property="links",
     *          type="object",
     *              @OA\Property(property="first", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/news?page=1"),
     *              @OA\Property(property="last", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/news?page=10"),
     *              @OA\Property(property="prev", type="string", example=null),
     *              @OA\Property(property="next", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/news?page=2"),
     *       ),
     *       @OA\Property(
     *          property="meta",
     *          type="object",
     *              @OA\Property(property="current_page", type="integer", example=1),
     *              @OA\Property(property="from", type="integer", example=1),
     *              @OA\Property(property="last_page", type="integer", example=10),
     *              @OA\Property(
     *                property="links",
     *                type="array",
     *                @OA\Items(
     *                    type = "object",
     *                    @OA\Property(property="url", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/news?page=1"),
     *                    @OA\Property(property="label", type="string", example="1"),
     *                    @OA\Property(property="active", type="boolean", example=true),
     *                ),
     *              ),
     *       ),
     *       @OA\Property(property="unread_count", type="integer", example=10),
     *    )
     *  )
     * )
     */
    public function index(Request $request)
    {
        return $this->repo->index($request);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/news/admin",
     *  summary="Get all news for admin",
     *  description="Get all news for admin",
     *  operationId="Get all news admin",
     *  tags={"News"},
     *  @OA\Parameter(
     *      name="order_by",
     *      in="query",
     *      description="Sort order. Default to release_time descending if not set.",
     *      @OA\Schema(
     *          type="string",
     *          example="release_time,desc"
     *      )
     *  ),
     *  @OA\Parameter(
     *      name="limit",
     *      in="query",
     *      description="Max items to return. Set <= 0 to fetch all rows. Default to paging if not set.",
     *      @OA\Schema(
     *          type="string",
     *          format="int",
     *          example=5
     *      )
     *  ),
     *  @OA\Parameter(
     *      name="page",
     *      in="query",
     *      description="Page number to return",
     *      @OA\Schema(
     *          type="string",
     *          format="int",
     *          example=1
     *      )
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Get all news success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get all news success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="News 9"),
     *              @OA\Property(property="content", type="string", example="content"),
     *              @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/400x300.jpg"),
     *              @OA\Property(property="policy", type="string", example="policy"),
     *              @OA\Property(property="is_new", type="boolean", example=true),
     *              @OA\Property(property="is_public", type="boolean", example=true),
     *              @OA\Property(property="release_time", type="string", example="2021-03-18 08:08:02"),
     *              @OA\Property(property="created_at", type="string", example="2021-03-18 08:08:02"),
     *              @OA\Property(property="updated_at", type="string", example="2021-03-18 08:08:02"),
     *          )
     *       ),
     *       @OA\Property(
     *          property="links",
     *          type="object",
     *              @OA\Property(property="first", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/news/admin?page=1"),
     *              @OA\Property(property="last", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/news/admin?page=10"),
     *              @OA\Property(property="prev", type="string", example=null),
     *              @OA\Property(property="next", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/news/admin?page=2"),
     *       ),
     *       @OA\Property(
     *          property="meta",
     *          type="object",
     *              @OA\Property(property="current_page", type="integer", example=1),
     *              @OA\Property(property="from", type="integer", example=1),
     *              @OA\Property(property="last_page", type="integer", example=10),
     *              @OA\Property(
     *                property="links",
     *                type="array",
     *                @OA\Items(
     *                    type = "object",
     *                    @OA\Property(property="url", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/news/admin?page=1"),
     *                    @OA\Property(property="label", type="string", example="1"),
     *                    @OA\Property(property="active", type="boolean", example=true),
     *                ),
     *              ),
     *       ),
     *       @OA\Property(property="unread_count", type="integer", example=10),
     *    )
     *  )
     * )
     */
    public function indexAdmin(Request $request)
    {
        return $this->repo->indexAdmin($request);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/news/{news_id}",
     *  summary="Get a news info by id",
     *  description="Get a news info by id",
     *  operationId="Find",
     *  tags={"News"},
     * @OA\Parameter(
     *     name="news_id",
     *     in="path",
     *     description="ID of news to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Find news success",
     *    @OA\JsonContent(ref="#/components/schemas/MemberNewsResource")
     *  )
     * )
     */
    public function show(Request $request, \App\Models\News $news)
    {
        return $this->repo->show($request, $news);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/news/admin/{news_id}",
     *  summary="Get a news info by id",
     *  description="Get a news info by id",
     *  operationId="Find news admin",
     *  tags={"News"},
     * @OA\Parameter(
     *     name="news_id",
     *     in="path",
     *     description="ID of news to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Find news success",
     *    @OA\JsonContent(ref="#/components/schemas/NewsResource")
     *  )
     * )
     */
    public function showAdmin(Request $request, \App\Models\News $news)
    {
        return $this->repo->showAdmin($request, $news);
    }

    /**
     * @OA\Post(
     * path="/api/v1/news",
     * summary="Create a news",
     * description="Create a new news",
     * operationId="Insert",
     * tags={"News"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Create a news",
     *    @OA\JsonContent(
     *       required={"title","content","release_time","thumbnail"},
     *       @OA\Property(property="title", type="string", example="News title"),
     *       @OA\Property(property="content", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *       @OA\Property(property="is_public", type="boolean", example=false),
     *       @OA\Property(property="policy", type="string", example="na"),
     *       @OA\Property(property="thumbnail", type="file", example="images/news/400x300.jpg"),
     *       @OA\Property(property="release_time", type="string", example="2020-11-28 03:05:06"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert news success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Insert news success"),
     *       @OA\Property(
     *              property="data",
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=2),
     *              @OA\Property(property="title", type="string", example="News title"),
     *              @OA\Property(property="content", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *              @OA\Property(property="is_public", type="boolean", example=false),
     *              @OA\Property(property="is_new", type="boolean", example=true),
     *              @OA\Property(property="policy", type="string", example="na"),
     *              @OA\Property(property="thumbnail", type="file", example="localhost:801/images/news/400x300.jpg"),
     *              @OA\Property(property="release_time", type="string", example="2020-11-28 03:05:06"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27 03:05:06"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27 03:37:17"),
     *          )
     *        )
     *     )
     * )
     */
    public function store(NewsPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Post(
     * path="/api/v1/news/{news_id}",
     * summary="Update a news info by id",
     * description="Update a news info by id",
     * operationId="Update",
     * tags={"News"},
     * @OA\Parameter(
     *     name="news_id",
     *     in="path",
     *     description="ID of news to update",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Update news",
     *    @OA\JsonContent(
     *       required={"title","content","release_time"},
     *       @OA\Property(property="title", type="string", example="News title"),
     *       @OA\Property(property="content", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *       @OA\Property(property="is_public", type="boolean", example=true),
     *       @OA\Property(property="policy", type="string", example="na"),
     *       @OA\Property(property="thumbnail", type="file", example="localhost:801/images/news/400x300.jpg"),
     *       @OA\Property(property="release_time", type="string", example="2020-11-28 03:05:06"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update news success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update news success"),
     *       @OA\Property(
     *              property="data",
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="title", type="string", example="News title"),
     *              @OA\Property(property="content", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *              @OA\Property(property="is_public", type="boolean", example=true),
     *              @OA\Property(property="is_new", type="boolean", example=true),
     *              @OA\Property(property="policy", type="string", example="na"),
     *              @OA\Property(property="thumbnail", type="string", example="localhost:801/images/news/400x300.jpg"),
     *              @OA\Property(property="release_time", type="string", example="2020-11-28 03:05:06"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27 03:05:06"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27 03:37:17"),
     *          )
     *        )
     *     )
     * )
     */
    public function update(NewsPutRequest $request, \App\Models\News $news)
    {
        return $this->repo->update($request, $news);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/news/{news_id}",
     *  summary="Delete a news",
     *  description="Delete a news by id",
     *  operationId="Delete",
     *  tags={"News"},
     * @OA\Parameter(
     *     name="news_id",
     *     in="path",
     *     description="ID of news to delete",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete news success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete news success"),
     *       @OA\Property(
     *              property="data",
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="title", type="string", example="News title"),
     *              @OA\Property(property="content", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *              @OA\Property(property="is_public", type="boolean", example=false),
     *              @OA\Property(property="is_new", type="boolean", example=true),
     *              @OA\Property(property="policy", type="string", example="na"),
     *              @OA\Property(property="thumbnail", type="string", example="localhost:801/images/news/400x300.jpg"),
     *              @OA\Property(property="release_time", type="string", example="2020-11-28 03:05:06"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27 03:05:06"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27 03:37:17"),
     *          )
     *        )
     *  )
     * )
     */
    public function destroy(\App\Models\News $news)
    {
        return $this->repo->destroy($news);
    }
}
