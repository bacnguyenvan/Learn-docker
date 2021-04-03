<?php

namespace App\Http\Controllers;

use App\Contracts\RouteContract;
use \App\Http\Requests\RoutePostRequest;
use Illuminate\Http\Request;
class RouteController extends Controller
{
    private $repo;

    public function __construct(RouteContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/routes",
     *  summary="Get all routes",
     *  description="Get all routes",
     *  operationId="Get all",
     *  tags={"Routes"},
     *  @OA\Response(
     *    response=200,
     *    description="Get all route success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get all route success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="string", example=1),
     *          @OA\Property(property="area_id", type="number", example=1),
     *          @OA\Property(property="number", type="number", example=1),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="description", type="text", example="description"),
     *          @OA\Property(property="stamina_level", type="number", example=1),
     *          @OA\Property(property="range", type="float", example=8.5),
     *          @OA\Property(property="total_elevation", type="float", example=1000.5),
     *          @OA\Property(property="journey_time", type="number", example=60.5),
     *          @OA\Property(property="line_color", type="string", example="EA0000"),
     *          @OA\Property(
     *             property="geometry",
     *             type="array",
     *             @OA\Items(
     *              type="array",
     *              example ={ 130.111679, 31.421721},
     *              @OA\Items(type="number", example=""),
     *             ),
     *          ),
     *          @OA\Property(property="point_center", type="string", example=null),
     *          @OA\Property(property="zoom_level", type="float", example=8.5),
     *          @OA\Property(property="badge_thumbnail", type="string", example="http://localhost:801/images/badges/medal_cycling.png"),
     *          @OA\Property(property="stamp_thumbnail", type="string", example="http://localhost:801/images/stamps/stamp_cycling.png"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *          @OA\Property(
     *             property="activities",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="トレッキング"),
     *              @OA\Property(property="value", type="string", example="climb"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="tags",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="scenes",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="thumbnail", type="string", example="400x300.jpg"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="points",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=9),
     *              @OA\Property(property="support_id", type="string", example=7),
     *              @OA\Property(property="name", type="string", example="modi"),
     *              @OA\Property(property="number", type="string", example=30),
     *              @OA\Property(property="index", type="string", example=7),
     *              @OA\Property(property="title", type="string", example="recusandae"),
     *              @OA\Property(property="description", type="string", example="enim"),
     *              @OA\Property(property="address", type="string", example="375 Lexus Courts\nAutumnburgh, NJ 98447"),
     *              @OA\Property(property="tel", type="string", example= "337.944.3439 x946"),
     *              @OA\Property(property="latitude", type="float", example=57.621657),
     *              @OA\Property(property="longitude", type="float", example=-50.641566),
     *              @OA\Property(property="elevation", type="float", example=727.11),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3237.88),
     *              @OA\Property(property="time_to_next", type="float", example=2190.84),
     *              @OA\Property(property="site_url", type="string", example="http://www.smith.com/"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://muller.com/id-non-nihil-mollitia-voluptatem"),
     *              @OA\Property(property="other", type="string", example="quos"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="landmarks",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=8),
     *              @OA\Property(property="name", type="string", example="maiores"),
     *              @OA\Property(property="description", type="string", example="modi"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="latitude", type="float", example=44.414311),
     *              @OA\Property(property="longitude", type="float", example=-27.976629),
     *              @OA\Property(property="category", type="string", example="nesciunt"),
     *              @OA\Property(property="address", type="string", example="62274 Alta Isle Suite 100\nNorth Wiltontown, WI 86381"),
     *              @OA\Property(property="tel", type="string", example="632.871.4064 x8158"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="stamps",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=10),
     *              @OA\Property(property="name", type="string", example="omnis"),
     *              @OA\Property(property="description", type="string", example="aut"),
     *              @OA\Property(property="latitude", type="float", example=-10.950005),
     *              @OA\Property(property="longitude", type="float", example=58.231753),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="type", type="string", example="magnam"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="area",
     *             type="object",
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="number", type="number", example=1),
     *             @OA\Property(property="name", type="string", example="Rollin Walter"),
     *             @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *             @OA\Property(property="slogan", type="string", example="CAN all that."),
     *             @OA\Property(property="description", type="string", example="There could be no chance of this, so that they couldn't see it?' So she stood still."),
     *             @OA\Property(property="latitude", type="float", example=-86.788785),
     *             @OA\Property(property="longitude", type="float", example=85.515077),
     *             @OA\Property(property="zoom_level", type="number", example=9),
     *             @OA\Property(property="catalog_file", type="string", example="ASTjdEWJtOKXSCrCVOfDpeTg5ltBnapGXz0xWogoNgSxqFuLMMm5BpPDVjttAtmEDQAwoQk2KeH9254Xn0M8XxVYMs8S"),
     *             @OA\Property(property="map_file", type="string", example="lPukygTkCHO0vgiXYHoV4FDLNCXCgc4WCogssBskNkSoYkwXaPHqSnI0XeWzXkrX1AfIcz5e58AIW"),
     *             ),
     *          )
     *       ),
     *        )
     *  )
     * )
     */
    public function index(Request $request)
    {
        return $this->repo->index($request);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/routes/{route_id}",
     *  summary="Get all routes by route id",
     *  description="Get all routes by route id",
     *  operationId="Find",
     *  tags={"Routes"},
     * @OA\Parameter(
     *     name="route_id",
     *     in="path",
     *     description="ID of route to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Find route success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Find route success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="string", example=1),
     *          @OA\Property(property="area_id", type="number", example=1),
     *          @OA\Property(property="number", type="number", example=1),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="description", type="text", example="description"),
     *          @OA\Property(property="stamina_level", type="number", example=1),
     *          @OA\Property(property="range", type="float", example=8.5),
     *          @OA\Property(property="total_elevation", type="float", example=1000.5),
     *          @OA\Property(property="journey_time", type="number", example=60.5),
     *          @OA\Property(property="line_color", type="string", example="EA0000"),
     *          @OA\Property(
     *             property="geometry",
     *             type="array",
     *             @OA\Items(
     *              type="array",
     *              example ={ 130.111679, 31.421721},
     *              @OA\Items(type="number", example=""),
     *             ),
     *          ),
     *          @OA\Property(property="point_center", type="string", example=null),
     *          @OA\Property(property="zoom_level", type="float", example=8.5),
     *          @OA\Property(property="badge_thumbnail", type="string", example="http://localhost:801/images/badges/medal_cycling.png"),
     *          @OA\Property(property="stamp_thumbnail", type="string", example="http://localhost:801/images/stamps/stamp_cycling.png"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *          @OA\Property(
     *             property="activities",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="トレッキング"),
     *              @OA\Property(property="value", type="string", example="climb"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="tags",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="scenes",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="thumbnail", type="string", example="400x300.jpg"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="points",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=9),
     *              @OA\Property(property="support_id", type="string", example=7),
     *              @OA\Property(property="name", type="string", example="modi"),
     *              @OA\Property(property="number", type="string", example=30),
     *              @OA\Property(property="index", type="string", example=7),
     *              @OA\Property(property="title", type="string", example="recusandae"),
     *              @OA\Property(property="description", type="string", example="enim"),
     *              @OA\Property(property="address", type="string", example="375 Lexus Courts\nAutumnburgh, NJ 98447"),
     *              @OA\Property(property="tel", type="string", example= "337.944.3439 x946"),
     *              @OA\Property(property="latitude", type="float", example=57.621657),
     *              @OA\Property(property="longitude", type="float", example=-50.641566),
     *              @OA\Property(property="elevation", type="float", example=727.11),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3237.88),
     *              @OA\Property(property="time_to_next", type="float", example=2190.84),
     *              @OA\Property(property="site_url", type="string", example="http://www.smith.com/"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://muller.com/id-non-nihil-mollitia-voluptatem"),
     *              @OA\Property(property="other", type="string", example="quos"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="landmarks",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=8),
     *              @OA\Property(property="name", type="string", example="maiores"),
     *              @OA\Property(property="description", type="string", example="modi"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="latitude", type="float", example=44.414311),
     *              @OA\Property(property="longitude", type="float", example=-27.976629),
     *              @OA\Property(property="category", type="string", example="nesciunt"),
     *              @OA\Property(property="address", type="string", example="62274 Alta Isle Suite 100\nNorth Wiltontown, WI 86381"),
     *              @OA\Property(property="tel", type="string", example="632.871.4064 x8158"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="stamps",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=10),
     *              @OA\Property(property="name", type="string", example="omnis"),
     *              @OA\Property(property="description", type="string", example="aut"),
     *              @OA\Property(property="latitude", type="float", example=-10.950005),
     *              @OA\Property(property="longitude", type="float", example=58.231753),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="type", type="string", example="magnam"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="area",
     *             type="object",
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="number", type="number", example=1),
     *             @OA\Property(property="name", type="string", example="Rollin Walter"),
     *             @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *             @OA\Property(property="slogan", type="string", example="CAN all that."),
     *             @OA\Property(property="description", type="string", example="There could be no chance of this, so that they couldn't see it?' So she stood still."),
     *             @OA\Property(property="latitude", type="float", example=-86.788785),
     *             @OA\Property(property="longitude", type="float", example=85.515077),
     *             @OA\Property(property="zoom_level", type="number", example=9),
     *             @OA\Property(property="catalog_file", type="string", example="ASTjdEWJtOKXSCrCVOfDpeTg5ltBnapGXz0xWogoNgSxqFuLMMm5BpPDVjttAtmEDQAwoQk2KeH9254Xn0M8XxVYMs8S"),
     *             @OA\Property(property="map_file", type="string", example="lPukygTkCHO0vgiXYHoV4FDLNCXCgc4WCogssBskNkSoYkwXaPHqSnI0XeWzXkrX1AfIcz5e58AIW"),
     *             ),
     *          )
     *        )
     *     )
     *  )
     * )
     */
    public function show(\App\Models\Route $route)
    {
        return $this->repo->show($route);
    }

    public function getTiles(\App\Models\Route $route)
    {
        return $this->repo->getTiles($route,);
    }

    /**
     * @OA\Post(
     * path="/api/v1/routes",
     * summary="Insert route",
     * description="Insert route",
     * operationId="Insert",
     * tags={"Routes"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Insert route",
     *    @OA\JsonContent(
     *       required={"area_id","number","name","description","stamina_level","range","total_elevation","journey_time","line_color","geometry","point_center"},
     *       @OA\Property(property="area_id", type="number", example=1),
     *       @OA\Property(property="number", type="number", example=1),
     *       @OA\Property(property="name", type="string", example="example"),
     *       @OA\Property(property="description", type="text", example="description"),
     *       @OA\Property(property="activity_id", type="[]", example="[1,2]"),
     *       @OA\Property(property="stamina_level", type="number", example=1),
     *       @OA\Property(property="range", type="float", example=8.5),
     *       @OA\Property(property="total_elevation", type="float", example=1000.5),
     *       @OA\Property(property="diff_elevation", type="float", example=1000.5),
     *       @OA\Property(property="journey_time", type="number", example=60.5),
     *       @OA\Property(property="line_color", type="string", example="EA0000"),
     *       @OA\Property(property="geometry", type="[]", example="[“43.382445 143.579871”,“44.382445 144.579871”]"),
     *       @OA\Property(property="point_center", type="string", example="“43.382445 143.579871”"),
     *       @OA\Property(property="zoom_level", type="float", example="14.5"),
     *       @OA\Property(property="landmark_id", type="[]", example="[2,3,4]"),
     *       @OA\Property(property="point_id", type="[]", example="[2,3,4]"),
     *       @OA\Property(property="tag_id", type="[]", example="[2,3,4]"),
     *       @OA\Property(property="warning_id", type="[]", example="[2,3,4]"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert route success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Insert route success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="string", example=1),
     *          @OA\Property(property="area_id", type="number", example=1),
     *          @OA\Property(property="number", type="number", example=1),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="description", type="text", example="description"),
     *          @OA\Property(property="stamina_level", type="number", example=1),
     *          @OA\Property(property="range", type="float", example=8.5),
     *          @OA\Property(property="total_elevation", type="float", example=1000.5),
     *          @OA\Property(property="journey_time", type="number", example=60.5),
     *          @OA\Property(property="line_color", type="string", example="EA0000"),
     *          @OA\Property(property="badge_thumbnail", type="string", example="http://localhost:801/images/badges/medal_cycling.png"),
     *          @OA\Property(property="stamp_thumbnail", type="string", example="http://localhost:801/images/stamps/stamp_cycling.png"),
     *          @OA\Property(
     *             property="activities",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="トレッキング"),
     *              @OA\Property(property="value", type="string", example="climb"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="tags",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="scenes",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="thumbnail", type="string", example="400x300.jpg"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="points",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=9),
     *              @OA\Property(property="support_id", type="string", example=7),
     *              @OA\Property(property="name", type="string", example="modi"),
     *              @OA\Property(property="number", type="string", example=30),
     *              @OA\Property(property="index", type="string", example=7),
     *              @OA\Property(property="title", type="string", example="recusandae"),
     *              @OA\Property(property="description", type="string", example="enim"),
     *              @OA\Property(property="address", type="string", example="375 Lexus Courts\nAutumnburgh, NJ 98447"),
     *              @OA\Property(property="tel", type="string", example= "337.944.3439 x946"),
     *              @OA\Property(property="latitude", type="float", example=57.621657),
     *              @OA\Property(property="longitude", type="float", example=-50.641566),
     *              @OA\Property(property="elevation", type="float", example=727.11),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3237.88),
     *              @OA\Property(property="time_to_next", type="float", example=2190.84),
     *              @OA\Property(property="site_url", type="string", example="http://www.smith.com/"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://muller.com/id-non-nihil-mollitia-voluptatem"),
     *              @OA\Property(property="other", type="string", example="quos"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="landmarks",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=8),
     *              @OA\Property(property="name", type="string", example="maiores"),
     *              @OA\Property(property="description", type="string", example="modi"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="latitude", type="float", example=44.414311),
     *              @OA\Property(property="longitude", type="float", example=-27.976629),
     *              @OA\Property(property="category", type="string", example="nesciunt"),
     *              @OA\Property(property="address", type="string", example="62274 Alta Isle Suite 100\nNorth Wiltontown, WI 86381"),
     *              @OA\Property(property="tel", type="string", example="632.871.4064 x8158"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="stamps",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=10),
     *              @OA\Property(property="name", type="string", example="omnis"),
     *              @OA\Property(property="description", type="string", example="aut"),
     *              @OA\Property(property="latitude", type="float", example=-10.950005),
     *              @OA\Property(property="longitude", type="float", example=58.231753),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="type", type="string", example="magnam"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="area",
     *             type="object",
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="number", type="number", example=1),
     *             @OA\Property(property="name", type="string", example="Rollin Walter"),
     *             @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *             @OA\Property(property="slogan", type="string", example="CAN all that."),
     *             @OA\Property(property="description", type="string", example="There could be no chance of this, so that they couldn't see it?' So she stood still."),
     *             @OA\Property(property="latitude", type="float", example=-86.788785),
     *             @OA\Property(property="longitude", type="float", example=85.515077),
     *             @OA\Property(property="zoom_level", type="number", example=9),
     *             @OA\Property(property="catalog_file", type="string", example="ASTjdEWJtOKXSCrCVOfDpeTg5ltBnapGXz0xWogoNgSxqFuLMMm5BpPDVjttAtmEDQAwoQk2KeH9254Xn0M8XxVYMs8S"),
     *             @OA\Property(property="map_file", type="string", example="lPukygTkCHO0vgiXYHoV4FDLNCXCgc4WCogssBskNkSoYkwXaPHqSnI0XeWzXkrX1AfIcz5e58AIW"),
     *             ),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *        )
     *      )
     * )
     * )
     */
    public function store(RoutePostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1/routes/{route_id}",
     * summary="Update route by id",
     * description="Update route by route id",
     * operationId="Update",
     * tags={"Routes"},
     * @OA\Parameter(
     *     name="route_id",
     *     in="path",
     *     description="ID of route to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Update route",
     *    @OA\JsonContent(
      *       required={"area_id","number","name","description","stamina_level","range","total_elevation","journey_time","line_color","geometry","point_center"},
     *       @OA\Property(property="area_id", type="number", example=1),
     *       @OA\Property(property="number", type="number", example=1),
     *       @OA\Property(property="name", type="string", example="example"),
     *       @OA\Property(property="description", type="text", example="description"),
     *       @OA\Property(property="activity_id", type="[]", example="[1,2]"),
     *       @OA\Property(property="stamina_level", type="number", example=1),
     *       @OA\Property(property="range", type="float", example=8.5),
     *       @OA\Property(property="total_elevation", type="float", example=1000.5),
     *       @OA\Property(property="diff_elevation", type="float", example=1000.5),
     *       @OA\Property(property="journey_time", type="number", example=60.5),
     *       @OA\Property(property="line_color", type="string", example="EA0000"),
     *       @OA\Property(property="geometry", type="[]", example="[“43.382445 143.579871”,“44.382445 144.579871”]"),
     *       @OA\Property(property="point_center", type="string", example="“43.382445 143.579871”"),
     *       @OA\Property(property="zoom_level", type="float", example="14.5"),
     *       @OA\Property(property="landmark_id", type="[]", example="[2,3,4]"),
     *       @OA\Property(property="point_id", type="[]", example="[2,3,4]"),
     *       @OA\Property(property="tag_id", type="[]", example="[2,3,4]"),
     *       @OA\Property(property="warning_id", type="[]", example="[2,3,4]"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update route success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update route success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="string", example=1),
     *          @OA\Property(property="area_id", type="number", example=1),
     *          @OA\Property(property="number", type="number", example=1),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="description", type="text", example="description"),
     *          @OA\Property(property="movement", type="string", example="cycling"),
     *          @OA\Property(property="stamina_level", type="number", example=1),
     *          @OA\Property(property="range", type="float", example=8.5),
     *          @OA\Property(property="total_elevation", type="float", example=1000.5),
     *          @OA\Property(property="journey_time", type="number", example=60.5),
     *          @OA\Property(property="line_color", type="string", example="EA0000"),
     *          @OA\Property(property="badge_thumbnail", type="string", example="http://localhost:801/images/badges/medal_cycling.png"),
     *          @OA\Property(property="stamp_thumbnail", type="string", example="http://localhost:801/images/stamps/stamp_cycling.png"),
     *          @OA\Property(
     *             property="activities",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="トレッキング"),
     *              @OA\Property(property="value", type="string", example="climb"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="tags",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="scenes",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="thumbnail", type="string", example="400x300.jpg"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="points",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=9),
     *              @OA\Property(property="support_id", type="string", example=7),
     *              @OA\Property(property="name", type="string", example="modi"),
     *              @OA\Property(property="number", type="string", example=30),
     *              @OA\Property(property="index", type="string", example=7),
     *              @OA\Property(property="title", type="string", example="recusandae"),
     *              @OA\Property(property="description", type="string", example="enim"),
     *              @OA\Property(property="address", type="string", example="375 Lexus Courts\nAutumnburgh, NJ 98447"),
     *              @OA\Property(property="tel", type="string", example= "337.944.3439 x946"),
     *              @OA\Property(property="latitude", type="float", example=57.621657),
     *              @OA\Property(property="longitude", type="float", example=-50.641566),
     *              @OA\Property(property="elevation", type="float", example=727.11),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3237.88),
     *              @OA\Property(property="time_to_next", type="float", example=2190.84),
     *              @OA\Property(property="site_url", type="string", example="http://www.smith.com/"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://muller.com/id-non-nihil-mollitia-voluptatem"),
     *              @OA\Property(property="other", type="string", example="quos"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="landmarks",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=8),
     *              @OA\Property(property="name", type="string", example="maiores"),
     *              @OA\Property(property="description", type="string", example="modi"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="latitude", type="float", example=44.414311),
     *              @OA\Property(property="longitude", type="float", example=-27.976629),
     *              @OA\Property(property="category", type="string", example="nesciunt"),
     *              @OA\Property(property="address", type="string", example="62274 Alta Isle Suite 100\nNorth Wiltontown, WI 86381"),
     *              @OA\Property(property="tel", type="string", example="632.871.4064 x8158"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="stamps",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=10),
     *              @OA\Property(property="name", type="string", example="omnis"),
     *              @OA\Property(property="description", type="string", example="aut"),
     *              @OA\Property(property="latitude", type="float", example=-10.950005),
     *              @OA\Property(property="longitude", type="float", example=58.231753),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="type", type="string", example="magnam"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="area",
     *             type="object",
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="number", type="number", example=1),
     *             @OA\Property(property="name", type="string", example="Rollin Walter"),
     *             @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *             @OA\Property(property="slogan", type="string", example="CAN all that."),
     *             @OA\Property(property="description", type="string", example="There could be no chance of this, so that they couldn't see it?' So she stood still."),
     *             @OA\Property(property="latitude", type="float", example=-86.788785),
     *             @OA\Property(property="longitude", type="float", example=85.515077),
     *             @OA\Property(property="zoom_level", type="number", example=9),
     *             @OA\Property(property="catalog_file", type="string", example="ASTjdEWJtOKXSCrCVOfDpeTg5ltBnapGXz0xWogoNgSxqFuLMMm5BpPDVjttAtmEDQAwoQk2KeH9254Xn0M8XxVYMs8S"),
     *             @OA\Property(property="map_file", type="string", example="lPukygTkCHO0vgiXYHoV4FDLNCXCgc4WCogssBskNkSoYkwXaPHqSnI0XeWzXkrX1AfIcz5e58AIW"),
     *             ),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *        )
     *        )
     *     )
     * )
     */
    public function update(RoutePostRequest $request, \App\Models\Route $route)
    {
        return $this->repo->update($request, $route);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/routes/{route_id}",
     *  summary="Delete route by id",
     *  description="Delete route by route id",
     *  operationId="Delete",
     *  tags={"Routes"},
     * @OA\Parameter(
     *     name="route_id",
     *     in="path",
     *     description="ID of route to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete route success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete route success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="string", example=1),
     *          @OA\Property(property="area_id", type="number", example=1),
     *          @OA\Property(property="number", type="number", example=1),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="description", type="text", example="description"),
     *          @OA\Property(property="stamina_level", type="number", example=1),
     *          @OA\Property(property="range", type="float", example=8.5),
     *          @OA\Property(property="total_elevation", type="float", example=1000.5),
     *          @OA\Property(property="journey_time", type="number", example=60.5),
     *          @OA\Property(property="line_color", type="string", example="EA0000"),
     *          @OA\Property(
     *             property="geometry",
     *             type="array",
     *             @OA\Items(
     *              type="array",
     *              example ={ 130.111679, 31.421721},
     *              @OA\Items(type="number", example=""),
     *             ),
     *          ),
     *          @OA\Property(property="point_center", type="string", example=null),
     *          @OA\Property(property="zoom_level", type="float", example=8.5),
     *          @OA\Property(property="badge_thumbnail", type="string", example="http://localhost:801/images/badges/medal_cycling.png"),
     *          @OA\Property(property="stamp_thumbnail", type="string", example="http://localhost:801/images/stamps/stamp_cycling.png"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *          @OA\Property(
     *             property="activities",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="tags",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="scenes",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="thumbnail", type="string", example="400x300.jpg"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="points",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=9),
     *              @OA\Property(property="support_id", type="string", example=7),
     *              @OA\Property(property="name", type="string", example="modi"),
     *              @OA\Property(property="number", type="string", example=30),
     *              @OA\Property(property="index", type="string", example=7),
     *              @OA\Property(property="title", type="string", example="recusandae"),
     *              @OA\Property(property="description", type="string", example="enim"),
     *              @OA\Property(property="address", type="string", example="375 Lexus Courts\nAutumnburgh, NJ 98447"),
     *              @OA\Property(property="tel", type="string", example= "337.944.3439 x946"),
     *              @OA\Property(property="latitude", type="float", example=57.621657),
     *              @OA\Property(property="longitude", type="float", example=-50.641566),
     *              @OA\Property(property="elevation", type="float", example=727.11),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3237.88),
     *              @OA\Property(property="time_to_next", type="float", example=2190.84),
     *              @OA\Property(property="site_url", type="string", example="http://www.smith.com/"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://muller.com/id-non-nihil-mollitia-voluptatem"),
     *              @OA\Property(property="other", type="string", example="quos"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="landmarks",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=8),
     *              @OA\Property(property="name", type="string", example="maiores"),
     *              @OA\Property(property="description", type="string", example="modi"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="latitude", type="float", example=44.414311),
     *              @OA\Property(property="longitude", type="float", example=-27.976629),
     *              @OA\Property(property="category", type="string", example="nesciunt"),
     *              @OA\Property(property="address", type="string", example="62274 Alta Isle Suite 100\nNorth Wiltontown, WI 86381"),
     *              @OA\Property(property="tel", type="string", example="632.871.4064 x8158"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="stamps",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=10),
     *              @OA\Property(property="name", type="string", example="omnis"),
     *              @OA\Property(property="description", type="string", example="aut"),
     *              @OA\Property(property="latitude", type="float", example=-10.950005),
     *              @OA\Property(property="longitude", type="float", example=58.231753),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="type", type="string", example="magnam"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="area",
     *             type="object",
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="number", type="number", example=1),
     *             @OA\Property(property="name", type="string", example="Rollin Walter"),
     *             @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *             @OA\Property(property="slogan", type="string", example="CAN all that."),
     *             @OA\Property(property="description", type="string", example="There could be no chance of this, so that they couldn't see it?' So she stood still."),
     *             @OA\Property(property="latitude", type="float", example=-86.788785),
     *             @OA\Property(property="longitude", type="float", example=85.515077),
     *             @OA\Property(property="zoom_level", type="number", example=9),
     *             @OA\Property(property="catalog_file", type="string", example="ASTjdEWJtOKXSCrCVOfDpeTg5ltBnapGXz0xWogoNgSxqFuLMMm5BpPDVjttAtmEDQAwoQk2KeH9254Xn0M8XxVYMs8S"),
     *             @OA\Property(property="map_file", type="string", example="lPukygTkCHO0vgiXYHoV4FDLNCXCgc4WCogssBskNkSoYkwXaPHqSnI0XeWzXkrX1AfIcz5e58AIW"),
     *             ),
     *          )
     *        )
     *  )
     * )
     */
    public function destroy(\App\Models\Route $route)
    {
        return $this->repo->destroy($route);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/routes/filters",
     *  summary="Get list routes from params condition",
     *  description="Get list routes from params condition",
     *  operationId="filters",
     *  tags={"Routes"},
     * @OA\Parameter(
     *     name="route_id",
     *     in="path",
     *     description="ID of route to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\Parameter(
     *     name="position",
     *     in="query",
     *     description="Latitude longitude values",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="string",
     *         default="31.421721,130.111679",
     *         example="31.421721,130.111679"
     *     )
     * ),
     * @OA\Parameter(
     *     name="area",
     *     in="query",
     *     description="Area id",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="int",
     *         default="1",
     *         example="1"
     *     )
     * ),
     * @OA\Parameter(
     *     name="tags",
     *     in="query",
     *     description="Tags ids",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="string",
     *         default="1,2,3",
     *         example="1,2,3"
     *     )
     * ),
     * @OA\Parameter(
     *     name="activities",
     *     in="query",
     *     description="Activities ids",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="string",
     *         default="1,2",
     *         example="1,2"
     *     )
     * ),
     * @OA\Parameter(
     *     name="scenes",
     *     in="query",
     *     description="Scenes ids",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="string",
     *         default="1,2,3",
     *         example="1,2,3"
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Get list routes based on filters condition",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get routes success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="string", example=1),
     *          @OA\Property(property="area_id", type="number", example=1),
     *          @OA\Property(property="number", type="number", example=1),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="description", type="text", example="description"),
     *          @OA\Property(property="stamina_level", type="number", example=1),
     *          @OA\Property(property="range", type="float", example=8.5),
     *          @OA\Property(property="total_elevation", type="float", example=1000.5),
     *          @OA\Property(property="journey_time", type="number", example=60.5),
     *          @OA\Property(property="line_color", type="string", example="EA0000"),
     *          @OA\Property(
     *             property="geometry",
     *             type="array",
     *             @OA\Items(
     *              type="array",
     *              example ={ 130.111679, 31.421721},
     *              @OA\Items(type="number", example=""),
     *             ),
     *          ),
     *          @OA\Property(property="point_center", type="string", example=null),
     *          @OA\Property(property="zoom_level", type="float", example=8.5),
     *          @OA\Property(property="badge_thumbnail", type="string", example="http://localhost:801/images/badges/medal_cycling.png"),
     *          @OA\Property(property="stamp_thumbnail", type="string", example="http://localhost:801/images/stamps/stamp_cycling.png"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *          @OA\Property(
     *             property="activities",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="tags",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="scenes",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="thumbnail", type="string", example="400x300.jpg"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="points",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=9),
     *              @OA\Property(property="support_id", type="string", example=7),
     *              @OA\Property(property="name", type="string", example="modi"),
     *              @OA\Property(property="number", type="string", example=30),
     *              @OA\Property(property="index", type="string", example=7),
     *              @OA\Property(property="title", type="string", example="recusandae"),
     *              @OA\Property(property="description", type="string", example="enim"),
     *              @OA\Property(property="address", type="string", example="375 Lexus Courts\nAutumnburgh, NJ 98447"),
     *              @OA\Property(property="tel", type="string", example= "337.944.3439 x946"),
     *              @OA\Property(property="latitude", type="float", example=57.621657),
     *              @OA\Property(property="longitude", type="float", example=-50.641566),
     *              @OA\Property(property="elevation", type="float", example=727.11),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3237.88),
     *              @OA\Property(property="time_to_next", type="float", example=2190.84),
     *              @OA\Property(property="site_url", type="string", example="http://www.smith.com/"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://muller.com/id-non-nihil-mollitia-voluptatem"),
     *              @OA\Property(property="other", type="string", example="quos"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="landmarks",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=8),
     *              @OA\Property(property="name", type="string", example="maiores"),
     *              @OA\Property(property="description", type="string", example="modi"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="latitude", type="float", example=44.414311),
     *              @OA\Property(property="longitude", type="float", example=-27.976629),
     *              @OA\Property(property="category", type="string", example="nesciunt"),
     *              @OA\Property(property="address", type="string", example="62274 Alta Isle Suite 100\nNorth Wiltontown, WI 86381"),
     *              @OA\Property(property="tel", type="string", example="632.871.4064 x8158"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="stamps",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=10),
     *              @OA\Property(property="name", type="string", example="omnis"),
     *              @OA\Property(property="description", type="string", example="aut"),
     *              @OA\Property(property="latitude", type="float", example=-10.950005),
     *              @OA\Property(property="longitude", type="float", example=58.231753),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="type", type="string", example="magnam"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="area",
     *             type="object",
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="number", type="number", example=1),
     *             @OA\Property(property="name", type="string", example="Rollin Walter"),
     *             @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *             @OA\Property(property="slogan", type="string", example="CAN all that."),
     *             @OA\Property(property="description", type="string", example="There could be no chance of this, so that they couldn't see it?' So she stood still."),
     *             @OA\Property(property="latitude", type="float", example=-86.788785),
     *             @OA\Property(property="longitude", type="float", example=85.515077),
     *             @OA\Property(property="zoom_level", type="number", example=9),
     *             @OA\Property(property="catalog_file", type="string", example="ASTjdEWJtOKXSCrCVOfDpeTg5ltBnapGXz0xWogoNgSxqFuLMMm5BpPDVjttAtmEDQAwoQk2KeH9254Xn0M8XxVYMs8S"),
     *             @OA\Property(property="map_file", type="string", example="lPukygTkCHO0vgiXYHoV4FDLNCXCgc4WCogssBskNkSoYkwXaPHqSnI0XeWzXkrX1AfIcz5e58AIW"),
     *             ),
     *          )
     *       ),
     *    )
     *  )
     * )
     */
    public function filters()
    {
        return $this->repo->filters();
    }

    public function getRoutesByActivity(Request $request)
    {
        return $this->repo->getRoutesByActivity($request);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/routes/{route_id}/badge",
     *  summary="Delete badge by route id",
     *  description="Delete badge by route id",
     *  operationId="Delete",
     *  tags={"Routes"},
     * @OA\Parameter(
     *     name="route_id",
     *     in="path",
     *     description="ID of route to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete badge success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete badge success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="string", example=1),
     *          @OA\Property(property="area_id", type="number", example=1),
     *          @OA\Property(property="number", type="number", example=1),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="description", type="text", example="description"),
     *          @OA\Property(property="stamina_level", type="number", example=1),
     *          @OA\Property(property="range", type="float", example=8.5),
     *          @OA\Property(property="total_elevation", type="float", example=1000.5),
     *          @OA\Property(property="journey_time", type="number", example=60.5),
     *          @OA\Property(property="line_color", type="string", example="EA0000"),
     *          @OA\Property(
     *             property="geometry",
     *             type="array",
     *             @OA\Items(
     *              type="array",
     *              example ={ 130.111679, 31.421721},
     *              @OA\Items(type="number", example=""),
     *             ),
     *          ),
     *          @OA\Property(property="point_center", type="string", example=null),
     *          @OA\Property(property="zoom_level", type="float", example=8.5),
     *          @OA\Property(property="badge_thumbnail", type="string", example=""),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *          @OA\Property(
     *             property="activities",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="tags",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="scenes",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="example"),
     *              @OA\Property(property="thumbnail", type="string", example="400x300.jpg"),
     *              @OA\Property(property="created_at", type="string", example=null),
     *              @OA\Property(property="updated_at", type="string", example=null),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="points",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=9),
     *              @OA\Property(property="support_id", type="string", example=7),
     *              @OA\Property(property="name", type="string", example="modi"),
     *              @OA\Property(property="number", type="string", example=30),
     *              @OA\Property(property="index", type="string", example=7),
     *              @OA\Property(property="title", type="string", example="recusandae"),
     *              @OA\Property(property="description", type="string", example="enim"),
     *              @OA\Property(property="address", type="string", example="375 Lexus Courts\nAutumnburgh, NJ 98447"),
     *              @OA\Property(property="tel", type="string", example= "337.944.3439 x946"),
     *              @OA\Property(property="latitude", type="float", example=57.621657),
     *              @OA\Property(property="longitude", type="float", example=-50.641566),
     *              @OA\Property(property="elevation", type="float", example=727.11),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="distance_to_next", type="float", example=3237.88),
     *              @OA\Property(property="time_to_next", type="float", example=2190.84),
     *              @OA\Property(property="site_url", type="string", example="http://www.smith.com/"),
     *              @OA\Property(property="montbell_friend_shop", type="string", example="http://muller.com/id-non-nihil-mollitia-voluptatem"),
     *              @OA\Property(property="other", type="string", example="quos"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T09:11:49.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="landmarks",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=8),
     *              @OA\Property(property="name", type="string", example="maiores"),
     *              @OA\Property(property="description", type="string", example="modi"),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="latitude", type="float", example=44.414311),
     *              @OA\Property(property="longitude", type="float", example=-27.976629),
     *              @OA\Property(property="category", type="string", example="nesciunt"),
     *              @OA\Property(property="address", type="string", example="62274 Alta Isle Suite 100\nNorth Wiltontown, WI 86381"),
     *              @OA\Property(property="tel", type="string", example="632.871.4064 x8158"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="stamps",
     *             type="array",
     *             @OA\Items(
     *              type="object",
     *              @OA\Property(property="id", type="string", example=10),
     *              @OA\Property(property="name", type="string", example="omnis"),
     *              @OA\Property(property="description", type="string", example="aut"),
     *              @OA\Property(property="latitude", type="float", example=-10.950005),
     *              @OA\Property(property="longitude", type="float", example=58.231753),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *              @OA\Property(property="type", type="string", example="magnam"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-26T08:54:50.000000Z"),
     *             ),
     *          ),
     *          @OA\Property(
     *             property="area",
     *             type="object",
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="number", type="number", example=1),
     *             @OA\Property(property="name", type="string", example="Rollin Walter"),
     *             @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/area_imgs/unnamed.jpg"),
     *             @OA\Property(property="slogan", type="string", example="CAN all that."),
     *             @OA\Property(property="description", type="string", example="There could be no chance of this, so that they couldn't see it?' So she stood still."),
     *             @OA\Property(property="latitude", type="float", example=-86.788785),
     *             @OA\Property(property="longitude", type="float", example=85.515077),
     *             @OA\Property(property="zoom_level", type="number", example=9),
     *             @OA\Property(property="catalog_file", type="string", example="ASTjdEWJtOKXSCrCVOfDpeTg5ltBnapGXz0xWogoNgSxqFuLMMm5BpPDVjttAtmEDQAwoQk2KeH9254Xn0M8XxVYMs8S"),
     *             @OA\Property(property="map_file", type="string", example="lPukygTkCHO0vgiXYHoV4FDLNCXCgc4WCogssBskNkSoYkwXaPHqSnI0XeWzXkrX1AfIcz5e58AIW"),
     *             ),
     *          )
     *        )
     *  )
     * )
     */
    public function destroyBadge($route_id)
    {
        return $this->repo->destroyBadge($route_id);
    }
}
