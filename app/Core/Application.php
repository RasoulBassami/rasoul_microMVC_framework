<?php

namespace App\Core;

use App\Core\Router;

class Application {

    public Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }
}