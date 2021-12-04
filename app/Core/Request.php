<?php

namespace App\Core;

class Request {

    public function __construct()
    {
    }

    public function getPath()
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}