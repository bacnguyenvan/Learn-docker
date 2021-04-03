<?php

namespace App\Http\Controllers;

use App\Contracts\PrefectureContract;

class PrefectureController extends Controller
{
    private $repo;

    public function __construct(PrefectureContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *     tags={"Prefectures"},
     *     summary="Get all prefecture",
     *     description="Get all prefecture",
     *     path="/api/v1/prefectures",
     * @OA\Response(
     *     response=200,
     *     description="Get all prefecture success",
     *     @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="200"),
     *         @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 format="query",
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="region_id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="北海道"),
     *                 @OA\Property(property="created_at", type="string", example=null),
     *                 @OA\Property(property="updated_at", type="string", example=null),
     *             )
     *         )
     *     )
     * ),
     * )
     */
    public function index()
    {
        return $this->repo->index();
    }

    public function show(\App\Models\Prefecture $prefecture)
    {
        return $this->repo->show($prefecture);
    }

    public function store($request)
    {
        return $this->repo->store($request);
    }

    public function update($request, \App\Models\Prefecture $prefecture)
    {
        return $this->repo->update($request, $prefecture);
    }

    public function destroy(\App\Models\Prefecture $prefecture)
    {
        return $this->repo->destroy($prefecture);
    }
}
