<?php

namespace App\Exceptions;

use Exception as BaseException;

class Exception extends BaseException
{
    public function render($request)
    {
        if (env("APP_DEBUG")) {
            return response()->json([
                'errors' => $this->getMessage(),
                'status_code' => $this->getCode(),
                'debug' => [
                    'file' => $this->getFile(),
                    'line' => $this->getLine(),
                    'trace' => $this->getTrace()
                ]
            ], $this->getCode());
        } else {
            return response()->json([
                'errors' => $this->getMessage(),
                'status_code' => $this->getCode()
            ], $this->getCode());
        }
    }

    // abstract public function apply();
}
