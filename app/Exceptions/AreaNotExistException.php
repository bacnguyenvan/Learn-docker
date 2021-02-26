<?php

namespace App\Exceptions;

use App\Exceptions\Exception;

class AreaNotExistException extends Exception
{
    public $message = 'Area does not exist or is empty';
    public $code = 401;
}
