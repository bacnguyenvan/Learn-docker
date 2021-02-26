<?php

namespace App\Http\Controllers;

use App\Contracts\TrackPointContract;
use \App\Http\Requests\TrackPointPostRequest;

class TrackPointController extends Controller
{
    private $repo;

    public function __construct(TrackPointContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Post(
     * path="/api/v1/trackpoints",
     * summary="Insert track point",
     * description="Insert track point",
     * operationId="Insert",
     * tags={"Track point"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Insert track point",
     *    @OA\JsonContent(
     *       required={"track_id","latitude","longitude","elevation","data"},
     *       @OA\Property(property="track_id", type="number", format="email", example=1),
     *       @OA\Property(property="latitude", type="number", format="boolean", example=2.10),
     *       @OA\Property(property="longitude", type="number", format="string", example=2.30),
     *       @OA\Property(property="elevation", type="number", format="", example=2.50),
     *       @OA\Property(property="data", type="string", example="et"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert track point success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Insert track point success"),
     *       @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(
     *              type = "object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="track_id", type="number", format="email", example=1),
     *              @OA\Property(property="latitude", type="number", format="boolean", example=2.10),
     *              @OA\Property(property="longitude", type="number", format="string", example=2.30),
     *              @OA\Property(property="elevation", type="number", format="", example=2.50),
     *              @OA\Property(property="data", type="string", example="et"),
     *              @OA\Property(property="created_at", type="string", example="2020-11-27T03:05:06.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2020-11-27T03:37:17.000000Z"),
     *          )
     *       ),
     *        )
     *     )
     * )
     */
    public function store(TrackPointPostRequest $request)
    {
        return $this->repo->store($request);
    }
}
