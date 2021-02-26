<?php

namespace App\Exceptions;

use App\Exceptions\Exception;

class MontBellTokenNotMatchException extends Exception
{
    public $message = 'MontBell Token Not Match';
    public $code = 401;
}
