<?php

namespace App\Http\Controllers;

use App\Contracts\PointContract;
use App\Http\Requests\PointPostRequest;
use App\Http\Requests\PointPutRequest;

class PointController extends Controller
{
    private $repo;

    public function __construct(PointContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/points",
     *  summary="Get all points",
     *  description="Get all points",
     *  operationId="Find all",
     *  tags={"Points"},
     *  @OA\Response(
     *    response=200,
     *    description="Get point success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get point success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=8),
     *              @OA\Property(property="support_id", type="integer", example=2),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="number", type="integer", example=2),
     *              @OA\Property(property="category", type="string", example="category"),
     *              @OA\Property(property="title", type="string", example="laudantium"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="string", example="370.903.1827 x52"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="elevation", type="float", example=1760.50),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3263.94),
     *              @OA\Property(property="time_to_next", type="float", example=2611.00),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="other", type="string", example="nobis"),
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
     *  path="/api/v1/points/{point_id}",
     *  summary="Get point",
     *  description="Get point by id",
     *  operationId="Find",
     *  tags={"Points"},
     * @OA\Parameter(
     *     name="point_id",
     *     in="path",
     *     description="ID of point to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Get point success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get point success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=8),
     *              @OA\Property(property="support_id", type="integer", example=2),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="number", type="integer", example=2),
     *              @OA\Property(property="category", type="string", example="category"),
     *              @OA\Property(property="title", type="string", example="laudantium"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="string", example="370.903.1827 x52"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="elevation", type="float", example=1760.50),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3263.94),
     *              @OA\Property(property="time_to_next", type="float", example=2611.00),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="other", type="string", example="nobis"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *        ),
     *      )
     *  ),
     * )
     */
    public function show(\App\Models\Point $point)
    {
        return $this->repo->show($point);
    }

    /**
     * @OA\Post(
     * path="/api/v1/points",
     * summary="create a point",
     * description="create a point",
     * operationId="create",
     * tags={"Points"},
     * @OA\RequestBody(
     *    required=false,
     *    description="Create point profile",
     *    @OA\JsonContent(
     *       required={"name", "area_id", "number", "title", "description", "address", "tel", "latitude", "longitude", "elevation", "thumbnail", "distance_to_next", "time_to_next", "site_url"},
     *       @OA\Property(property="area_id", type="integer", example=8),
     *       @OA\Property(property="support_id", type="integer", example=2),
     *       @OA\Property(property="number", type="integer", example=2),
     *       @OA\Property(property="name", type="string", example="tempore"),
     *       @OA\Property(property="category", type="string", example="category"),
     *       @OA\Property(property="title", type="string", example="laudantium"),
     *       @OA\Property(property="description", type="string", example="et"),
     *       @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *       @OA\Property(property="tel", type="string", example="370.903.1827 x52"),
     *       @OA\Property(property="latitude", type="float", example=-36.707632),
     *       @OA\Property(property="longitude", type="float", example=112.739408),
     *       @OA\Property(property="elevation", type="float", example=1760.50),
     *       @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *       @OA\Property(property="distance_to_next", type="float", example=3263.94),
     *       @OA\Property(property="time_to_next", type="float", example=2611.00),
     *       @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *       @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *       @OA\Property(property="other", type="string", example="nobis"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert point success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="insert point success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=8),
     *              @OA\Property(property="support_id", type="integer", example=2),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="number", type="integer", example=2),
     *              @OA\Property(property="category", type="string", example="category"),
     *              @OA\Property(property="title", type="string", example="laudantium"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="string", example="370.903.1827 x52"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="elevation", type="float", example=1760.50),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3263.94),
     *              @OA\Property(property="time_to_next", type="float", example=2611.00),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="other", type="string", example="nobis"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *      )
     * ),
     * )
     */
    public function store(PointPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1/points/{point_id}",
     * summary="Update point",
     * description="Update point by id",
     * operationId="update",
     * tags={"Points"},
     * @OA\Parameter(
     *     name="point_id",
     *     in="path",
     *     description="ID of point to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=false,
     *    description="Update point",
     *    @OA\JsonContent(
     *       @OA\Property(property="area_id", type="integer", example=8),
     *       @OA\Property(property="support_id", type="integer", example=2),
     *       @OA\Property(property="number", type="integer", example=2),
     *       @OA\Property(property="name", type="string", example="tempore"),
     *       @OA\Property(property="category", type="string", example="category"),
     *       @OA\Property(property="title", type="string", example="laudantium"),
     *       @OA\Property(property="description", type="string", example="et"),
     *       @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *       @OA\Property(property="tel", type="string", example="370.903.1827 x52"),
     *       @OA\Property(property="latitude", type="float", example=-36.707632),
     *       @OA\Property(property="longitude", type="float", example=112.739408),
     *       @OA\Property(property="elevation", type="float", example=1760.50),
     *       @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *       @OA\Property(property="distance_to_next", type="float", example=3263.94),
     *       @OA\Property(property="time_to_next", type="float", example=2611.00),
     *       @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *       @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *       @OA\Property(property="other", type="string", example="nobis"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update point success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update point success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=8),
     *              @OA\Property(property="support_id", type="integer", example=2),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="number", type="integer", example=2),
     *              @OA\Property(property="category", type="string", example="category"),
     *              @OA\Property(property="title", type="string", example="laudantium"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="string", example="370.903.1827 x52"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="elevation", type="float", example=1760.50),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3263.94),
     *              @OA\Property(property="time_to_next", type="float", example=2611.00),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="other", type="string", example="nobis"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *      )
     * ),
     * )
     */
    public function update(PointPutRequest $request, \App\Models\Point $point)
    {
        return $this->repo->update($request, $point);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/points/{point_id}",
     *  summary="Delete a point",
     *  description="Delete a point by id",
     *  operationId="Delete",
     *  tags={"Points"},
     * @OA\Parameter(
     *     name="point_id",
     *     in="path",
     *     description="ID of point to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete point success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete point success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=8),
     *              @OA\Property(property="support_id", type="integer", example=2),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="number", type="integer", example=2),
     *              @OA\Property(property="category", type="string", example="category"),
     *              @OA\Property(property="title", type="string", example="laudantium"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="string", example="370.903.1827 x52"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="elevation", type="float", example=1760.50),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3263.94),
     *              @OA\Property(property="time_to_next", type="float", example=2611.00),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="other", type="string", example="nobis"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *        )
     *  ),
     * )
     */
    public function destroy(\App\Models\Point $point)
    {
        return $this->repo->destroy($point);
    }
}
