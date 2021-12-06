<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Router;
use App\Core\View;



class Application {

    public static $ROOT_DIR;
    public static $BASE_DOMAIN;
    public static $app;
    public Request $request;
    public Router $router;
    public View $view;

    public function __construct($root, $domain)
    {
        self::$ROOT_DIR = $root;
        self::$BASE_DOMAIN = $domain;
        self::$app = $this;
        $this->request = new Request();
        $this->view = new View(self::$ROOT_DIR, self::$BASE_DOMAIN);
        $this->router = new Router($this->request, $this->view);
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        }
        catch (\Exception $e) {
            http_response_code($e->getCode());
            echo $this->view->renderView('errors' , ['e' => $e]);
        }
    }
}