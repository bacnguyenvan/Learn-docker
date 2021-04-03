<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log as LogFacade;
use Throwable;

class Log
{
    public function logError(string $message, Throwable $error)
    {
        LogFacade::error(sprintf("%s\n%s", $message, $error->getTraceAsString()));
    }
}
