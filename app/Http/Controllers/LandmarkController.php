<?php

namespace App\Http\Controllers;

use App\Contracts\LandmarkContract;
use App\Http\Requests\LandmarkPostRequest;
use App\Http\Requests\LandmarkPutRequest;

class LandmarkController extends Controller
{
    private $repo;

    public function __construct(LandmarkContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/landmarks",
     *  summary="Get all landmarks",
     *  description="Get all landmarks",
     *  operationId="Find all",
     *  tags={"Landmarks"},
     *  @OA\Response(
     *    response=200,
     *    description="Get landmark success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get landmark success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="support", type="string", example="caution_icon/p_icon/playground_icon/wc_icon/meal_icon/wifi_icon"),
     *              @OA\Property(property="category", type="string", example="restaurant"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="integer", example="370-903-1827"),
     *              @OA\Property(property="is_member_benefit", type="integer", example="1"),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
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
     *  path="/api/v1/landmarks/{landmark_id}",
     *  summary="Get landmark",
     *  description="Get landmark by id",
     *  operationId="Find",
     *  tags={"Landmarks"},
     * @OA\Parameter(
     *     name="landmark_id",
     *     in="path",
     *     description="ID of landmark to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Get landmark success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get landmark success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="support", type="string", example="caution_icon/p_icon/playground_icon/wc_icon/meal_icon/wifi_icon"),
     *              @OA\Property(property="category", type="string", example="restaurant"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="integer", example="370-903-1827"),
     *              @OA\Property(property="is_member_benefit", type="integer", example="1"),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *        ),
     *      )
     *  ),
     * )
     */
    public function show(\App\Models\Landmark $landmark)
    {
        return $this->repo->show($landmark);
    }

    /**
     * @OA\Post(
     * path="/api/v1/landmarks",
     * summary="create a landmark",
     * description="create a landmark",
     * operationId="create",
     * tags={"Landmarks"},
     * @OA\RequestBody(
     *    required=false,
     *    description="Create landmark profile",
     *    @OA\JsonContent(
     *       required={"area_id","name", "description", "category" ,"latitude", "longitude", "address"},
     *       @OA\Property(property="area_id", type="string", example="tempore"),
     *       @OA\Property(property="name", type="string", example="tempore"),
     *       @OA\Property(property="description", type="string", example="et"),
     *       @OA\Property(property="thumbnail", type="file", example="/images/landmarks/a.png"),
     *       @OA\Property(property="support", type="string", example="caution_icon/p_icon/playground_icon/wc_icon/meal_icon/wifi_icon"),
     *       @OA\Property(property="category", type="string", example="restaurant"),
     *       @OA\Property(property="latitude", type="float", example=-36.707632),
     *       @OA\Property(property="longitude", type="float", example=112.739408),
     *       @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *       @OA\Property(property="tel", type="integer", example="370-903-1827"),
     *       @OA\Property(property="is_member_benefit", type="integer", example="1"),
     *       @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *       @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert landmark success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="insert landmark success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="support", type="string", example="caution_icon/p_icon/playground_icon/wc_icon/meal_icon/wifi_icon"),
     *              @OA\Property(property="category", type="string", example="restaurant"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="integer", example="370-903-1827"),
     *              @OA\Property(property="is_member_benefit", type="integer", example="1"),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *      )
     * ),
     * )
     */
    public function store(LandmarkPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Post(
     * path="/api/v1/landmarks/{landmark_id}",
     * summary="Update landmark",
     * description="Update landmark by id",
     * operationId="update",
     * tags={"Landmarks"},
     * @OA\Parameter(
     *     name="landmark_id",
     *     in="path",
     *     description="ID of landmark to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=false,
     *    description="Update landmark",
     *    @OA\JsonContent(
     *       required={"area_id","name", "description", "category" ,"latitude", "longitude", "address"},
     *       @OA\Property(property="area_id", type="string", example="tempore"),
     *       @OA\Property(property="name", type="string", example="tempore"),
     *       @OA\Property(property="description", type="string", example="et"),
     *       @OA\Property(property="thumbnail", type="file", example="/images/landmarks/a.png"),
     *       @OA\Property(property="support", type="string", example="caution_icon/p_icon/playground_icon/wc_icon/meal_icon/wifi_icon"),
     *       @OA\Property(property="category", type="string", example="restaurant"),
     *       @OA\Property(property="latitude", type="float", example=-36.707632),
     *       @OA\Property(property="longitude", type="float", example=112.739408),
     *       @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *       @OA\Property(property="tel", type="integer", example="370-903-1827"),
     *       @OA\Property(property="is_member_benefit", type="integer", example="1"),
     *       @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *       @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update landmark success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update landmark success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost:801/images/landmarks/a.png"),
     *              @OA\Property(property="support", type="string", example="caution_icon/p_icon/playground_icon/wc_icon/meal_icon/wifi_icon"),
     *              @OA\Property(property="category", type="string", example="restaurant"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="integer", example="370-903-1827"),
     *              @OA\Property(property="is_member_benefit", type="integer", example="1"),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *      )
     * ),
     * )
     */
    public function update(LandmarkPutRequest $request, \App\Models\Landmark $landmark)
    {
        return $this->repo->update($request, $landmark);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/landmarks/{landmark_id}",
     *  summary="Delete a landmark",
     *  description="Delete a landmark by id",
     *  operationId="Delete",
     *  tags={"Landmarks"},
     * @OA\Parameter(
     *     name="landmark_id",
     *     in="path",
     *     description="ID of landmark to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete landmark success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete landmark success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *              @OA\Property(property="id", type="integer", example=11),
     *              @OA\Property(property="area_id", type="integer", example=11),
     *              @OA\Property(property="name", type="string", example="tempore"),
     *              @OA\Property(property="description", type="string", example="et"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/stamp_imgs/EKfFezb5L5TAheeS3WSvnxMy0kAMnXuizQn3T7qQ.jpeg"),
     *              @OA\Property(property="support", type="string", example="caution_icon/p_icon/playground_icon/wc_icon/meal_icon/wifi_icon"),
     *              @OA\Property(property="category", type="string", example="restaurant"),
     *              @OA\Property(property="latitude", type="float", example=-36.707632),
     *              @OA\Property(property="longitude", type="float", example=112.739408),
     *              @OA\Property(property="address", type="string", example="23691 Flatley Loaf\\nNew Lonie, MN 38407-5431"),
     *              @OA\Property(property="tel", type="integer", example="370-903-1827"),
     *              @OA\Property(property="is_member_benefit", type="integer", example="1"),
     *              @OA\Property(property="site_url", type="string", example="http://www.damore.com/voluptatem-consequatur-eos-iure-ipsa-explicabo-quos-quidem-non.html"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://kilback.com/commodi-natus-nisi-ut-est.html"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *         ),
     *        )
     *  ),
     * )
     */
    public function destroy(\App\Models\Landmark $landmark)
    {
        return $this->repo->destroy($landmark);
    }
}
