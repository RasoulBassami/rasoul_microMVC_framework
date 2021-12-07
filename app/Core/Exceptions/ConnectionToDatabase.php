<?php

namespace App\Core\Exceptions;

class ConnectionToDatabase extends \Exception
{
    protected $code = 500;
    protected $message = 'something went worng!';
}