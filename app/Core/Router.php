<?php

namespace App\Core;


class Router {

    public array $routes = [];

    public function __construct()
    {
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
}