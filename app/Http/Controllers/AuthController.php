<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;

class AuthController extends Controller
{
    private $repo;

    /**
     *
     */
    public function __construct(AuthContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @OA\Post(
     * path="/api/v1/auth/login",
     * summary="Member sign in",
     * description="Login by email, password",
     * operationId="login",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"username","password", "type","device_token"},
     *       @OA\Property(property="username", type="string", example="username"),
     *       @OA\Property(property="password", type="string", example="password"),
     *       @OA\Property(property="type", type="string", example="member"),
     *       @OA\Property(property="device_token", type="string", example="AHWR3LRhNIiotrpfJtK1"),
     *       @OA\Property(property="device_agent", type="string", example="Mozilla/5.0 (Windows 95) AppleWebKit/5322 (KHTML, like Gecko) Chrome/39.0.866.0 Mobile Safari/5322"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Login success",
     *    @OA\JsonContent(
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Login success"),
     *       @OA\Property(property="data", type="object",
     *           @OA\Property(property="member_id", type="string", example=1),
     *           @OA\Property(property="access_token", type="string", example="7b4267b17e12512af1ddc3a2cc313e3a7f2b3d22dbcb1b92cb127cf6596a15443a140863452ad4e9ae850f288921c5dff61bba6f3f422fb850942023956eb969"),
     *           @OA\Property(property="token_type", type="string", example="Bearer"),
     *           @OA\Property(property="device_token", type="string", format="type", example="AHWR3LRhNIiotrpfJtK1"),
     *           @OA\Property(property="device_agent", type="string", format="type", example="Mozilla/5.0 (Windows 95) AppleWebKit/5322 (KHTML, like Gecko) Chrome/39.0.866.0 Mobile Safari/5322"),
     *       ),
     *    )
     * )
     *)
     */
    public function login(\App\Http\Requests\AuthPostLoginRequest $request)
    {
        return $this->repo->login($request);
    }

    /**
     * @OA\Get(
     * path="/api/v1/auth/logout",
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
     * tags={"Authentication"},
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
    public function logout()
    {
        return $this->repo->logout();
    }
}
