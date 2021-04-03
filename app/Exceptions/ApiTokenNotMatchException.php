<?php

namespace App\Exceptions;

use App\Exceptions\Exception;

class ApiTokenNotMatchException extends Exception
{
    public $message = 'Api Token Not Match';
    public $code = 401;
}
