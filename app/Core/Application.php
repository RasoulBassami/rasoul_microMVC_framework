<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Response;
use App\Core\Database;
use App\Core\Router;
use App\Core\Controller;
use App\Core\View;
use App\Core\Session;
use App\Core\DbModel;

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
    public ?DbModel $user;
    public string $userClass;

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

        $this->userClass = $config['userClass'];
        $this->user = $this->getLoggedInUser($this->userClass);
    }

    public function getLoggedInUser($userClass)
    {
        $primaryValue = $this->session->get('user') ?? false;
        if($primaryValue) {
            $primaryKey = $userClass::primaryKey();
            return $userClass::findOne([$primaryKey => $primaryValue]);
        } 
        return null;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function login(DbModel $user) {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout() {

        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
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