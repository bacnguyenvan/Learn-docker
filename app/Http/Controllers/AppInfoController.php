<?php

namespace App\Http\Controllers;

use App\Contracts\AppInfoContract;
use App\Http\Requests\AppInfoPostRequest;

class AppInfoController extends Controller
{
    private $repo;

    public function __construct(AppInfoContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Get(
     *  path="/api/v1/appinfo",
     *  summary="Get app info",
     *  description="Get app info",
     *  operationId="Find",
     *  tags={"App Info"},
     *  @OA\Response(
     *    response=200,
     *    description="Get app success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Get app success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="name", type="string", example="jet_app"),
     *          @OA\Property(property="version", type="string", example="1.0.0"),
     *          @OA\Property(property="term_service", type="string", example="<div><h1>Term</h1><ul><li>rule 1</li><li>rule 1</li><li>rule 1</li></ul></div>"),
     *          @OA\Property(property="update_at", type="string", example=null),
     *          @OA\Property(property="created_at", type="string", example=null),
     *        ),
     *      )
     *  ),
     * )
     */
    public function show()
    {
        return $this->repo->show();
    }

    /**
     * @OA\Put(
     * path="/api/v1/appinfo",
     * summary="Update app info",
     * description="Update app info",
     * operationId="Update",
     * tags={"App Info"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Update app info",
     *    @OA\JsonContent(
     *       required={"name","version"},
     *       @OA\Property(property="name", type="string", format="string", example="jet_app"),
     *       @OA\Property(property="version", type="string", format="string", example="1.0.0"),
     *       @OA\Property(property="term_service", type="string", example="<div><h1>Term</h1><ul><li>rule 1</li><li>rule 1</li><li>rule 1</li></ul></div>"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update app success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update app success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="name", type="string", example="jet_app"),
     *          @OA\Property(property="version", type="string", example="1.0.0"),
     *          @OA\Property(property="term_service", type="string", example="<div><h1>Term</h1><ul><li>rule 1</li><li>rule 1</li><li>rule 1</li></ul></div>"),
     *          @OA\Property(property="update_at", type="string", example=null),
     *          @OA\Property(property="create_at", type="string", example=null),
     *         ),
     *      )
     * ),
     * )
     */
    public function store(AppInfoPostRequest $request)
    {
        return $this->repo->store($request);
    }
}
