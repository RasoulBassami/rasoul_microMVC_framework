<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Router;


class Application {

    public Request $request;
    public Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request );
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}