<?php

namespace App\Exceptions;

use App\Exceptions\Exception;

class MontBellTokenNotValidException extends Exception
{
    public $message = 'MontBell Token Not Valid';
    public $code = 401;
}
