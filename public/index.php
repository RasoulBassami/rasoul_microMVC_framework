<?php
include_once __DIR__ . "./../vendor/autoload.php";

use App\Core\Application;
use App\Controllers\FrontController;
use App\Controllers\AuthController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$base_domain = $_ENV['BASE_DOMAIN'];

$app = new Application(dirname(__DIR__) , $base_domain);


$app->router->get('/', [FrontController::class, 'home']);

$app->router->get('/contact', [FrontController::class, 'showContactForm']);
$app->router->post('/contact', [FrontController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'showRegisterForm']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();