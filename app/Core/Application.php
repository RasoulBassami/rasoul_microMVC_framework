<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Router;
use App\Core\View;



class Application {

    public static $ROOT_DIR;
    public static $BASE_DOMAIN;
    public static $Application;
    public Request $request;
    public Router $router;
    public View $view;

    public function __construct($root, $domain)
    {
        self::$ROOT_DIR = $root;
        self::$BASE_DOMAIN = $domain;
        self::$Application = $this;
        $this->request = new Request();
        $this->view = new View(self::$ROOT_DIR, self::$BASE_DOMAIN);
        $this->router = new Router($this->request, $this->view);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}