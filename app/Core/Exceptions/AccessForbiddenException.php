<?php

namespace App\Core\Exceptions;

class AccessForbiddenException extends \Exception
{
    protected $code = 403;
    protected $message = 'Access to the resource is forbidden.';
}