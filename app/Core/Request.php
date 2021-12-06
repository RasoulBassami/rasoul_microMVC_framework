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

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return ($this->method() === 'get') ?? false;
    }

    public function isPost()
    {
        return ($this->method() === 'post') ?? false;
    }
}