<?php

namespace App\Traits;

use Hash;

trait ResponseAPI
{
    /**
     * Core of response
     *
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode
     * @param   boolean         $isSuccess
     */
    private function coreResponse($message, $data = null, $statusCode = 200, $isSuccess = true)
    {
        // Check the params
        if (!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if ($isSuccess) {
            return response()->json([
                'status_code' => $statusCode,
                'message' => $message,
                'data' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'status_code' => $statusCode,
                'message' => $message,
                'errors' => $data,
            ], $statusCode);
        }
    }

    /**
     * Send any success response
     *
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    /**
     * Send any error response
     *
     * @param   string          $message
     * @param   integer         $statusCode
     */
    public function error($message, $errors, $statusCode = 500)
    {
        return $this->coreResponse($message, $errors, $statusCode, false);
    }
}
