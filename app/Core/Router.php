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
        $method = $this->request->method();
        $callback = $this->routes[$method][$Path] ?? false;

        if(!$callback) {
            throw new NotFoundedException();
        }

        if(is_string($callback)) {
            return $this->view->renderView($callback);
        }

        if(is_array($callback)) {

            # make an instance of string name of controller
            Application::$app->controller = new $callback[0](); 
            $callback[0] = Application::$app->controller;
            Application::$app->controller->action = $callback[1];

            foreach (Application::$app->controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request);
    }
}