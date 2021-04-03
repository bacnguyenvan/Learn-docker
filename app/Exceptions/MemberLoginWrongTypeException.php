<?php

namespace App\Exceptions;

use App\Exceptions\Exception;

class MemberLoginWrongTypeException extends Exception
{
    public $message = 'Type of member does not found';
    public $code = 401;
}
