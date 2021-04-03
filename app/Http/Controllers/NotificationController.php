<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationCreateRequest;
use App\Http\Requests\NotificationStoreFCMTokenRequest;
use App\Http\Requests\NotificationUpdateRequest;
use App\Contracts\NotificationContract;
use App\Http\Requests\NotificationSendRequest;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private NotificationContract $repo;

    public function __construct(NotificationContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/notifications",
     *     summary="Get all notifications",
     *     description="Get all notifications",
     *     operationId="Get all",
     *     tags={"Notifications"},
     *     @OA\Parameter(
     *         name="fetch_all",
     *         in="query",
     *         description="Return all rows (fetch_all=1) or per page (default)",
     *         @OA\Schema(
     *             type="string",
     *             format="int",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Get all notifications success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status_code", type="integer", example="200"),
     *             @OA\Property(property="message", type="string", example="Get all notifications success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type = "object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Notifications title"),
     *                     @OA\Property(property="body", type="string", example="Suscipit earum dicta rem atque. Vero facilis inventore tempora sapiente. Labore quis id enim eligendi quo debitis. Sit rerum quam temporibus sed."),
     *                     @OA\Property(property="delivery_time", type="string", example="2020-11-28 03:05:06"),
     *                     @OA\Property(property="created_at", type="string", example="2020-11-27 03:05:06"),
     *                     @OA\Property(property="updated_at", type="string", example="2020-11-27 03:37:17"),
     *                     @OA\Property(property="member_notifications", type="array",
     *                         @OA\Items(
     *                             type = "object",
     *                             @OA\Property(property="notification_id", type="integer", example=1),
     *                             @OA\Property(property="member_id", type="integer", example=1, description="0: all members | others: member_id matches the values"),
     *                             @OA\Property(property="status", type="integer", example=0, description="0: unsent | 1: sent | 2: error"),
     *                         ),
     *                     ),
     *                     @OA\Property(property="is_unsent", type="boolean", example=true),
     *                 ),
     *             ),
     *             @OA\Property(
     *                 property="links",
     *                 type="object",
     *                     @OA\Property(property="first", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/notifications?page=1"),
     *                     @OA\Property(property="last", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/notifications?page=10"),
     *                     @OA\Property(property="prev", type="string", example=null),
     *                     @OA\Property(property="next", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/notifications?page=2"),
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                     @OA\Property(property="current_page", type="integer", example=1),
     *                     @OA\Property(property="from", type="integer", example=1),
     *                     @OA\Property(property="last_page", type="integer", example=10),
     *                     @OA\Property(
     *                         property="links",
     *                         type="array",
     *                         @OA\Items(
     *                             type = "object",
     *                             @OA\Property(property="url", type="string", example="http:\/\/jet-api.lc:801\/api\/v1\/notifications?page=1"),
     *                             @OA\Property(property="label", type="string", example="1"),
     *                             @OA\Property(property="active", type="boolean", example=true),
     *                         ),
     *                     ),
     *                 )
     *             )
     *     )
     * )
     */
    public function index(Request $request)
    {
        return $this->repo->index($request->fetch_all);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/notifications/{notification_id}",
     *     summary="Get a notification info by id",
     *     description="Get a notification info by id",
     *     operationId="Find",
     *     tags={"Notifications"},
     *     @OA\Parameter(
     *         name="notification_id",
     *         in="path",
     *         description="ID of notification to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Find notification success",
     *         @OA\JsonContent(ref="#/components/schemas/NotificationResource")
     *     )
     * )
     */
    public function show($id)
    {
        return $this->repo->show($id);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/notifications",
     *     summary="Create a new notification",
     *     description="Create a new notification",
     *     operationId="Create",
     *     tags={"Notifications"},
     *     @OA\RequestBody(
     *        required=true,
     *        description="Input data",
     *        @OA\JsonContent(ref="#/components/schemas/NotificationCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Store notification successfully.",
     *         @OA\JsonContent(ref="#/components/schemas/NotificationResource")
     *     )
     * )
     */
    public function store(NotificationCreateRequest $request)
    {
        return $this->repo->store($request->prep());
    }

    /**
     * @OA\Put(
     *     path="/api/v1/notifications/{notification_id}",
     *     summary="Update a notification",
     *     description="Update a notification",
     *     operationId="Update",
     *     tags={"Notifications"},
     *     @OA\Parameter(
     *         name="notification_id",
     *         in="path",
     *         description="ID of notification to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        description="Input data",
     *        @OA\JsonContent(ref="#/components/schemas/NotificationUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Update notification successfully.",
     *         @OA\JsonContent(ref="#/components/schemas/NotificationResource")
     *     )
     * )
     */
    public function update($id, NotificationUpdateRequest $request)
    {
        return $this->repo->update($id, $request->prep());
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/notifications/{notification_id}",
     *     summary="Delete a notification",
     *     description="Delete a notification",
     *     operationId="Delete",
     *     tags={"Notifications"},
     *     @OA\Parameter(
     *         name="notification_id",
     *         in="path",
     *         description="ID of notification to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Update notification successfully.",
     *         @OA\JsonContent(ref="#/components/schemas/NotificationResource")
     *     )
     * )
     */
	public function destroy($id)
    {
        return $this->repo->destroy($id);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/notifications/fcm_token",
     *     summary="Store FCM registration token",
     *     description="Store FCM registration token",
     *     operationId="UpdateToken",
     *     tags={"Notifications"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Input data",
     *         @OA\JsonContent(ref="#/components/schemas/NotificationStoreFCMTokenRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Update FCM registration token success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status_code", type="integer", example="200"),
     *             @OA\Property(property="message", type="string", example="Update FCM registration token success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="device_token", type="string", example="AHWR3LRhNIiotrpfJtK1"),
     *                 @OA\Property(property="device_agent", type="string", example="Mozilla/5.0 (X11; Linux x86_64; rv:6.0) Gecko/20201119 Firefox/35.0"),
     *                 @OA\Property(property="fcm_token", type="string", example="I9o6m6L8FKY1z5PgChtvylcHt91t3NWK6t6wXQal"),
     *                 @OA\Property(property="created_at", type="string", example="2020-11-27 03:05:06"),
     *                 @OA\Property(property="updated_at", type="string", example="2020-11-27 03:37:17"),
     *             )
     *         )
     *     )
     * )
     */
    public function storeFCMToken(NotificationStoreFCMTokenRequest $request)
    {
        return $this->repo->storeFCMTokenAndSubscribeTopic($request->all());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/notifications/test",
     *     summary="Send test notification",
     *     description="Send test notification to FCM tokens stored in .env file",
     *     operationId="SendTest",
     *     tags={"Notifications"},
     *     @OA\RequestBody(
     *        required=true,
     *        description="Input data",
     *        @OA\JsonContent(ref="#/components/schemas/NotificationSendRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Send notification successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status_code", type="integer", example="200"),
     *             @OA\Property(property="message", type="string", example="Notifications sent."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="success", type="array", example={"e7HRyAHRG1kbI6Y4cJ2V5E", "APA91bGZXyIgCEUlTv2tT1"},
     *                     @OA\Items(type="string", description="FCM token")
     *                 ),
     *                 @OA\Property(property="failure", type="array", example={},
     *                     @OA\Items(type="string", description="FCM token")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function sendTestNotifications(NotificationSendRequest $request)
    {
        $result = $this->repo->sendTestNotification($request->only(['title', 'body']));

        return response()->json([
            'status_code' => 200,
            'message' => 'Notifications sent.',
            'data' => $result,
        ]);
    }
}
