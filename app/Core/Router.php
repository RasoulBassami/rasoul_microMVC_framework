<?php

namespace App\Core;

use App\Core\Request;

class Router {

    public array $routes = [];
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $Path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$Path] ?? false;

        if(!$callback) {
            return '404';
            exit;
        }

        return call_user_func($callback);
    }
}