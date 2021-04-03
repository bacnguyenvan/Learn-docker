<?php

namespace App\Http\Controllers;

use App\Contracts\MemberContract;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $repo;

    public function __construct(MemberContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     * path="/api/v1/members",
     * summary="Get member list",
     * description="Get member list",
     * tags={"Members"},
     * @OA\Response(
     *    response=200,
     *    description="Get members success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get members success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="montbell_login_user_id", type="string", example="muratatest1"),
     *          @OA\Property(property="member_mbc_no", type="string", example="04674514"),
     *          @OA\Property(property="member_web_no", type="string", example="W00073664"),
     *          @OA\Property(property="member_name", type="string", example="岳人かーどあり"),
     *          @OA\Property(property="mbc_yukokigen_year_month", type="string", example="2021年04月"),
     *          @OA\Property(property="mbc_update_flg", type="integer", example=0),
     *          @OA\Property(property="premium_card_name", type="string", example="ブルー"),
     *          @OA\Property(property="card_name", type="string", example="メンバーズカード"),
     *          @OA\Property(property="card_category_name", type="string", example=""),
     *          @OA\Property(property="card_img", type="string", example="https://www.montbell.jp/mypage/mypage_common/images/card_img/card_blue.jpg"),
     *          @OA\Property(property="card_type_renewal_flg", type="integer", example=0),
     *          @OA\Property(property="card_type_reenter_flg", type="integer", example=0),
     *          @OA\Property(property="member_points", type="integer", example=4),
     *          @OA\Property(property="support_card_img", type="string", example=""),
     *          @OA\Property(property="gakujin_update_flg", type="integer", example=0),
     *          @OA\Property(property="gakujin_subscriber_no", type="string", example="99999999"),
     *          @OA\Property(property="gakujin_manryo_year_month", type="string", example="2022年08月号"),
     *          @OA\Property(property="gakujin_yukokigen_year_month", type="string", example="2022年08月"),
     *          @OA\Property(property="gakujin_card_img", type="string", example="https://www.montbell.jp/mypage/mypage_common/images/card_img/gakujin.jpg"),
     *          @OA\Property(property="barcode_string", type="string", example="TX5uqvDGP>M*"),
     *          @OA\Property(property="barcode_retention_seconds", type="integer", example=300),
     *         ),
     *      )
     * ),
     *)
     */
    public function index()
    {
        return $this->repo->index();
    }

    /**
     * @OA\Get(
     * path="/api/v1/members/{member_id}",
     * summary="Get profile info",
     * description="Get member profile info",
     * operationId="getUserInformation",
     * @OA\Parameter(
     *     name="member_id",
     *     in="path",
     *     description="ID of member to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="76f58b2747fa65b4dc157f9c1c9bbff708bffac652d8f67a60cff95ef4faf956e2767846b811af4133e277a1664f195853864b911c87c3c6fcf4e6bcccaedb86",
     *     )
     * ),
     * tags={"Members"},
     * @OA\Response(
     *    response=200,
     *    description="Get profile success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get profile success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="member_mbc_no", type="string", example="04674514"),
     *          @OA\Property(property="member_web_no", type="string", example="W00073664"),
     *          @OA\Property(property="member_name", type="string", example="岳人かーどあり"),
     *          @OA\Property(property="mbc_yukokigen_year_month", type="string", example="2021年04月"),
     *          @OA\Property(property="mbc_update_flg", type="integer", example=0),
     *          @OA\Property(property="premium_card_name", type="string", example="ブルー"),
     *          @OA\Property(property="card_name", type="string", example="メンバーズカード"),
     *          @OA\Property(property="card_category_name", type="string", example=""),
     *          @OA\Property(property="card_img", type="string", example="https://www.montbell.jp/mypage/mypage_common/images/card_img/card_blue.jpg"),
     *          @OA\Property(property="card_type_renewal_flg", type="integer", example=0),
     *          @OA\Property(property="card_type_reenter_flg", type="integer", example=0),
     *          @OA\Property(property="member_points", type="integer", example=4),
     *          @OA\Property(property="support_card_img", type="string", example=""),
     *          @OA\Property(property="gakujin_update_flg", type="integer", example=0),
     *          @OA\Property(property="gakujin_subscriber_no", type="string", example="99999999"),
     *          @OA\Property(property="gakujin_manryo_year_month", type="string", example="2022年08月号"),
     *          @OA\Property(property="gakujin_yukokigen_year_month", type="string", example="2022年08月"),
     *          @OA\Property(property="gakujin_card_img", type="string", example="https://www.montbell.jp/mypage/mypage_common/images/card_img/gakujin.jpg"),
     *          @OA\Property(property="barcode_string", type="string", example="TX5uqvDGP>M*"),
     *          @OA\Property(property="barcode_retention_seconds", type="integer", example=300),
     *         ),
     *      )
     * ),
     *)
     */
    public function show(\App\Models\Member $member)
    {
        return $this->repo->show($member);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/members/{member_id}/stamps",
     *  summary="Get stamp list of user",
     *  description="Get stamp list of user",
     *  operationId="Get all",
     * @OA\Parameter(
     *     name="member_id",
     *     in="path",
     *     description="ID of member to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\Parameter(
     *     name="Authorization",
     *     example="76f58b2747fa65b4dc157f9c1c9bbff708bffac652d8f67a60cff95ef4faf956e2767846b811af4133e277a1664f195853864b911c87c3c6fcf4e6bcccaedb86",
     *     in="header",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     *  tags={"Members"},
     *  @OA\Response(
     *    response=200,
     *    description="Get stamp list success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get stamp list success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="string", example=1),
     *              @OA\Property(property="name", type="string", example="eos"),
     *              @OA\Property(property="description", type="text", example="ut"),
     *              @OA\Property(property="latitude", type="float", example=31.416663),
     *              @OA\Property(property="longitude", type="number", example=130.113251),
     *              @OA\Property(property="thumbnail", type="string", example="http://localhost/uploads/400x300.jpg"),
     *              @OA\Property(property="type", type="string", example="sint"),
     *              @OA\Property(property="created_at", type="string", example="2020-12-02T17:21:36.000000Z"),
     *              @OA\Property(
     *                  property="member",
     *                  type="object",
     *                  @OA\Property(property="id", type="string", example=1),
     *                  @OA\Property(property="montbell_login_user_id", type="string", example="muratatest5"),
     *                  @OA\Property(property="created_at", type="string", example="2020-12-02T17:21:36.000000Z"),
     *                  @OA\Property(property="updated_at", type="string", example="2020-12-04T06:26:04.000000Z"),
     *              ),
     *              @OA\Property(
     *                  property="route",
     *                  type="object",
     *                      @OA\Property(property="id", type="string", example=1),
     *                      @OA\Property(property="area_id", type="number", example=1),
     *                      @OA\Property(property="number", type="number", example=1),
     *                      @OA\Property(property="name", type="string", example="example"),
     *                      @OA\Property(property="description", type="text", example="description"),
     *                      @OA\Property(property="movement", type="string", example="drive"),
     *                      @OA\Property(property="stamina_level", type="number", example=1),
     *                      @OA\Property(property="range", type="float", example=8.5),
     *                      @OA\Property(property="max_elevation", type="float", example=1000.5),
     *                      @OA\Property(property="journey_time", type="number", example=60.5),
     *                      @OA\Property(property="line_color", type="string", example="red"),
     *                      @OA\Property(
     *                          property="geometry",
     *                          type="array",
     *                          @OA\Items(
     *                              type="array",
     *                              example ={ 130.111679, 31.421721},
     *                              @OA\Items(type="number", example=""),
     *                          ),
     *                      ),
     *                      @OA\Property(
     *                          property="point_center",
     *                          type="array",
     *                          example ={ 130.111679, 31.421721},
     *                          @OA\Items(type="number", example=""),
     *                      ),
     *                      @OA\Property(property="zoom_level", type="float", example=8.5),
     *              ),
     *          )
     *       ),
     *    )
     *  )
     * )
     */
    public function stamps(\App\Models\Member $member)
    {
        return $this->repo->stamps($member);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/members/{member_id}/tracks",
     *  summary="Get tracks list or last track of user",
     *  description="Get tracks list or last track of user",
     *  operationId="Get Track",
     * @OA\Parameter(
     *     name="member_id",
     *     in="path",
     *     description="ID of member to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\Parameter(
     *     name="Authorization",
     *     example="76f58b2747fa65b4dc157f9c1c9bbff708bffac652d8f67a60cff95ef4faf956e2767846b811af4133e277a1664f195853864b911c87c3c6fcf4e6bcccaedb86",
     *     in="header",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     * @OA\Parameter(
     *     name="order_by",
     *     in="query",
     *     description="Sort track ",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="string",
     *         default="true",
     *         example="id,desc"
     *     )
     * ),
     * @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="Get number of item of track list",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="string",
     *         default="true",
     *         example="1"
     *     )
     * ),
     *  tags={"Members"},
     *  @OA\Response(
     *    response=200,
     *    description="Get tracks list success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get tracks list success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="number", example=11),
     *              @OA\Property(property="route_id", type="number", example=12),
     *              @OA\Property(property="route_name", type="text", example="フレンドエリア「月山・朝日・飯豊・蔵王」サイクリングルート"),
     *              @OA\Property(property="route_description", type="float", example="Route Description"),
     *              @OA\Property(property="member_id", type="number", example=2),
     *              @OA\Property(property="name", type="string", example="Track 11"),
     *              @OA\Property(property="description", type="string", example="description"),
     *              @OA\Property(property="max_elevation", type="number", example=297),
     *              @OA\Property(property="total_time", type="number", example=2),
     *              @OA\Property(property="total_distance", type="number", example=100),
     *              @OA\Property(property="type", type="string", example="drive"),
     *              @OA\Property(
     *                  property="total_all",
     *                  type="object",
     *                  @OA\Property(property="elevation", type="string", example=1987),
     *                  @OA\Property(property="time", type="string", example=12),
     *                  @OA\Property(property="distance", type="string", example=269),
     *              ),
     *          )
     *       ),
     *    )
     *  )
     * )
     */
    public function tracks(\App\Models\Member $member)
    {
        return $this->repo->tracks($member);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/members/{member_id}/news",
     *  summary="Get news list of user",
     *  description="Get news list of user",
     *  operationId="GetNewsList",
     * @OA\Parameter(
     *     name="member_id",
     *     in="path",
     *     description="ID of member to return",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     * @OA\Parameter(
     *     name="Authorization",
     *     example="76f58b2747fa65b4dc157f9c1c9bbff708bffac652d8f67a60cff95ef4faf956e2767846b811af4133e277a1664f195853864b911c87c3c6fcf4e6bcccaedb86",
     *     in="header",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     * @OA\Parameter(
     *     name="order_by",
     *     in="query",
     *     description="Sort news ",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="string",
     *         default="true",
     *         example="id,desc"
     *     )
     * ),
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Paginate news List ",
     *     required=false,
     *     explode=true,
     *     @OA\Schema(
     *         type="string",
     *         default="true",
     *         example="1"
     *     )
     * ),
     *  tags={"Members"},
     *  @OA\Response(
     *    response=200,
     *    description="Get news list success",
     *    @OA\JsonContent(
     *        @OA\Property(property="status_code", type="integer", example="200"),
     *        @OA\Property(property="message", type="string", example="Get all notifications success"),
     *        @OA\Property(
     *            property="data",
     *            type="array",
     *            @OA\Items(
     *                type = "object",
     *                @OA\Property(property="id", type="number", example=1),
     *                @OA\Property(property="member_id", type="number", example=1),
     *                @OA\Property(property="news_id", type="text", example=1),
     *                @OA\Property(property="title", type="string", example="News 9"),
     *                @OA\Property(property="content", type="string", example="content"),
     *                @OA\Property(property="thumbnail", type="string", example="http://jet-api.ethan-tech.asia/400x300.jpg"),
     *                @OA\Property(property="policy", type="string", example="policy"),
     *                @OA\Property(property="is_new", type="boolean", example=true),
     *                @OA\Property(property="is_public", type="boolean", example=true),
     *                @OA\Property(property="is_read", type="boolean", example=false),
     *                @OA\Property(property="release_time", type="string", example="2021-03-18 08:08:02"),
     *                @OA\Property(property="created_at", type="string", example="2021-03-18 08:08:02"),
     *                @OA\Property(property="updated_at", type="string", example="2021-03-18 08:08:02"),
     *            )
     *        )
     *    )
     *  )
     * )
     */
    public function news(Request $request, \App\Models\Member $member)
    {
        return $this->repo->news($request, $member);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/members/{member_id}/news/{news_id}",
     *     summary="Get news of user by Id",
     *     description="Get news of user by Id",
     *     operationId="GetNewsDetail",
     *     @OA\Parameter(
     *         name="member_id",
     *         in="path",
     *         description="ID of member to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="news_id",
     *         in="path",
     *         description="ID of news to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="Authorization",
     *         example="76f58b2747fa65b4dc157f9c1c9bbff708bffac652d8f67a60cff95ef4faf956e2767846b811af4133e277a1664f195853864b911c87c3c6fcf4e6bcccaedb86",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     tags={"Members"},
     *     @OA\Response(
     *       response=200,
     *       description="Get news list success",
     *       @OA\JsonContent(ref="#/components/schemas/MemberNewsResource")
     *     )
     * )
     */
    public function getNews(\App\Models\Member $member, \App\Models\News $news)
    {
        return $this->repo->getNews($member, $news);
    }

    /**
     * This method should no longer be needed
     */
    public function updateNews(\App\Http\Requests\MemberNewsPutRequest $request, \App\Models\Member $member, \App\Models\MemberNews $news)
    {
        return $this->repo->updateNews($request, $member, $news);
    }
}
