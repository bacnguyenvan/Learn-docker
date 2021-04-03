<?php

namespace App\Exceptions;

use App\Exceptions\Exception;

class AppInfoLastNotFoundException extends Exception
{
    public $message = 'App Info Not Found';
    public $code = 401;
}
