<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Exceptions\NotFoundedException;

class Router {

    public array $routes = [];
    public Request $request;
    public View $view;

    public function __construct(Request $request, View $view)
    {
        $this->request = $request;
        $this->view = $view;
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
            throw new NotFoundedException();
        }

        if(is_string($callback)) {
            return $this->view->renderView($callback);
        }

        return call_user_func($callback);
    }
}