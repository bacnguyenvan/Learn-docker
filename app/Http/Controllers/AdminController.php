<?php

namespace App\Http\Controllers;

use App\Contracts\AdminContract;

class AdminController extends Controller
{
    private $repo;

    public function __construct(AdminContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\GET(
     *     tags={"Admins"},
     *     summary="Get all admins",
     *     description="Get all admins data",
     *     path="/api/v1/admins",
     * @OA\Response(
     *     response=200,
     *     description="List data",
     *     @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="200"),
     *         @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 format="query",
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="鳥取（鳥取県）"),
     *                 @OA\Property(property="email", type="string", example="example@gmail.com"),
     *                 @OA\Property(property="level", type="string", example="1"),
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


    /**
     * @OA\Post(
     * path="/api/v1/admins",
     * summary="create a admin",
     * description="create a admin",
     * operationId="create",
     * tags={"Admins"},
     * @OA\Parameter(
     *     name="name",
     *     in="path",
     *     description="User name",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="John"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="email",
     *     in="path",
     *     description="User email",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="admin@gmail.com"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="password",
     *     in="path",
     *     description="User password",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="xxxxx"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="level",
     *     in="path",
     *     description="Authority level",
     *     required=true,
     *     @OA\Schema(
     *         type="int",
     *         example=1
     *     ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Insert admin success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="insert admin success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="email", type="string", example="example@gmail.com"),
     *          @OA\Property(property="level", type="integer", example="1"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *      )
     * ),
     * )
     */
    public function store(\App\Http\Requests\AdminPostRequest $request)
    {
        return $this->repo->store($request);
    }

    /**
     * @OA\Get(
     *     tags={"Admins"},
     *     summary="Get admin by id",
     *     description="Get admin by id",
     *     path="/api/v1/admin/id",
     * @OA\Parameter(
     *     parameter="id",
     *     in="path",
     *     name="id",
     *     description="ID",
     *     required=true,
     *     @OA\Schema(
     *          type="integer",
     *          example=1
     *      )
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Get admin success",
     *     @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="200"),
     *         @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 format="query",
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="鳥取（鳥取県）"),
     *                 @OA\Property(property="email", type="string", example="example@gmail.com"),
     *                 @OA\Property(property="level", type="string", example="1"),
     *                 @OA\Property(property="created_at", type="string", example=null),
     *                 @OA\Property(property="updated_at", type="string", example=null),
     *             )
     *         )
     *     )
     * ),
     * )
     */
    public function show(\App\Models\Admin $admin)
    {
        return $this->repo->show($admin);
    }

    /**
     * @OA\Put(
     * path="/api/v1/admins/{id}",
     * summary="update admin by id",
     * description="update a admin",
     * operationId="update",
     * tags={"Admins"},
     * @OA\Parameter(
     *     name="name",
     *     in="path",
     *     description="User name",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="John"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="email",
     *     in="path",
     *     description="User email",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         example="example@gmail.com"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="password",
     *     in="path",
     *     description="User password",
     *     @OA\Schema(
     *         type="string",
     *         example="xxxxx"
     *     ),
     * ),
     * @OA\Parameter(
     *     name="level",
     *     in="path",
     *     description="Authority level",
     *     required=true,
     *     @OA\Schema(
     *         type="int",
     *         example=1
     *     ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Update admin success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Update admin success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="email", type="string", example="example@gmail.com"),
     *          @OA\Property(property="level", type="integer", example="1"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *      )
     * ),
     * )
     */
    public function update(\App\Http\Requests\AdminPutRequest $request, \App\Models\Admin $admin)
    {
        return $this->repo->update($request, $admin);
    }

    /**
     * @OA\Delete(
     *  path="/api/v1/admin/{id}",
     *  summary="Delete a admin",
     *  description="Delete a admin by id",
     *  operationId="Delete",
     *  tags={"Admins"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of admin",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64",
     *         example=1
     *     )
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Delete admin success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Delete admin success"),
     *       @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="1"),
     *          @OA\Property(property="name", type="string", example="example"),
     *          @OA\Property(property="email", type="string", example="example@gmail.com"),
     *          @OA\Property(property="level", type="integer", example="1"),
     *          @OA\Property(property="created_at", type="string", example=null),
     *          @OA\Property(property="updated_at", type="string", example=null),
     *         ),
     *        )
     *  ),
     * )
     */
    public function destroy(\App\Models\Admin $admin)
    {
        return $this->repo->destroy($admin);
    }

    /**
     * @OA\Post(
     * path="/api/v1/admins/login",
     * summary="Admin login",
     * description="Login by userId, password",
     * operationId="login",
     * tags={"Admins"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="x@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Login success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Login success"),
     *       @OA\Property(property="data", type="object",
     *           @OA\Property(property="name", type="string", example="Admin"),
     *           @OA\Property(property="email", type="string", example="Admin@gmail.com"),
     *           @OA\Property(property="access_token", type="string", example="7b4267b17e12512af1ddc3a2cc313e3a7f2b3d22dbcb1b92cb127cf6596a15443a140863452ad4e9ae850f288921c5dff61bba6f3f422fb850942023956eb969"),
     *           @OA\Property(property="token_type", type="string", example="Bearer")
     *       ),
     *    )
     * )
     *)
     */
    public function login(\App\Http\Requests\AdminLoginRequest $request)
    {
        return $this->repo->login($request);
    }

    /**
     * @OA\Get(
     * path="/api/v1/admins/logout",
     * summary="Logout",
     * description="Logout",
     * operationId="logout",
     * @OA\Parameter(
     *     name="Authorization",
     *     example="76f58b2747fa65b4dc157f9c1c9bbff708bffac652d8f67a60cff95ef4faf956e2767846b811af4133e277a1664f195853864b911c87c3c6fcf4e6bcccaedb86",
     *     in="header",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     * ),
     * tags={"Admins"},
     * @OA\Response(
     *    response=200,
     *    description="Logout success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Logout success"),
     *       @OA\Property(property="data", type="string", example=true),
     *      )
     * ),
     *)
     */

    public function refreshToken()
    {
        return $this->repo->refreshToken();
    }
    public function logout()
    {
        return $this->repo->logout();
    }
}