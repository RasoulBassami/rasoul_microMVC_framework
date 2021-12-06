<?php

namespace App\Core\Exceptions;

class NotFoundedException extends \Exception
{
    protected $code = 404;
    protected $message = 'page not found!';
}