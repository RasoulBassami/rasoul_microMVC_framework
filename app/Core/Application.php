<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Response;
use App\Core\Database;
use App\Core\Router;
use App\Core\Controller;
use App\Core\View;
use App\Core\Session;

class Application {

    public static $ROOT_DIR;
    public static $BASE_DOMAIN;
    public static $app;
    public Request $request;
    public Response $response;
    public Database $db;
    public Router $router;
    public Controller $controller;
    public View $view;
    public Session $session;

    public function __construct(string $root, string $domain, array $config)
    {
        self::$ROOT_DIR = $root;
        self::$BASE_DOMAIN = $domain;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View(self::$ROOT_DIR, self::$BASE_DOMAIN);
        $this->router = new Router($this->request, $this->view);
        $this->session = new Session();

        try {
            $this->db = new Database($config['db']);
        } catch(\Exception $e) {
            http_response_code($e->getCode());
            echo $this->view->renderView('errors' , ['e' => $e]);
        }
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
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