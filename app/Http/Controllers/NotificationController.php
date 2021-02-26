<?php

namespace App\Http\Controllers;

use App\Contracts\NotificationContract;
use \App\Http\Requests\NotificationPostRequest;
use \App\Http\Requests\NotificationPutRequest;

class NotificationController extends Controller
{
    private $repo;

    public function __construct(NotificationContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/notifications",
     *  summary="Get all notifications",
     *  description="Get all notifications",
     *  operationId="Get all",
     *  tags={"Notifications"},
     *  @OA\Response(
     *    response=200,
     *    description="Get all notification success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get all notification success"),
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
     *  path="/api/v1/notifications/{notification_id}",
     *  summary="Get a notification info by id",
     *  description="Get a notification info by id",
     *  operationId="Find",
     *  tags={"Notifications"},
     * @OA\Parameter(
     *     name="notification_id",
     *     in="path",
     *     description="ID of notification to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Find notification success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Find notification success"),
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
    public function show(\App\Models\Notification $notification)
    {
        return $this->repo->show($notification);
    }

    /**
     * @OA\Post(
     * path="/api/v1/notifications",
     * summary="Create a notification",
     * description="Create a new notification",
     * operationId="Insert",
     * tags={"Notifications"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Create a notification",
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
     *    description="Insert notification success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Insert notification success"),
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
    public function store(NotificationPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1/notifications/{notification_id}",
     * summary="Update a notification info by id",
     * description="Update a notification info by id",
     * operationId="Update",
     * tags={"Notifications"},
     * @OA\Parameter(
     *     name="notification_id",
     *     in="path",
     *     description="ID of notification to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Update notification",
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
     *    description="Update notification success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update notification success"),
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
    public function update(NotificationPutRequest $request, \App\Models\Notification $notification)
    {
        return $this->repo->update($request, $notification);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/notifications/{notification_id}",
     *  summary="Delete a notification",
     *  description="Delete a notification by id",
     *  operationId="Delete",
     *  tags={"Notifications"},
     * @OA\Parameter(
     *     name="notification_id",
     *     in="path",
     *     description="ID of notification to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete notification success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete notification success"),
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
    public function destroy(\App\Models\Notification $notification)
    {
        return $this->repo->destroy($notification);
    }
}
