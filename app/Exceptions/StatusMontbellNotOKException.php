<?php

namespace App\Exceptions;

use App\Exceptions\Exception;

class StatusMontbellNotOKException extends Exception
{
    public $message = 'Log out status not OK';
    public $code = 401;
}
