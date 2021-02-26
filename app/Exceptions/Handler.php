<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
    }
    public function render($request, \Throwable $e)
    {
        parent::render($request, $e);

        if ($e instanceof \Illuminate\Database\QueryException) {
            return response()->json([
                'status_code' => 422,
                'message' => 'Cannot execute query',
                'errors' => $e->getMessage()
            ], 422);
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Not Found',
                'errors' => 'Not Found',
            ], 404);
        }

        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Model not found',
                'errors' => $e->getMessage()
            ], 404);
        }

        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Unauthenticated',
                'errors' => $e->getMessage()
            ], 401);
        }

        return response()->json([
            'status_code' => $e->getCode(),
            'message' => $e->getMessage()
        ], $e->getCode());
    }
}
