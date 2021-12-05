<?php
include_once __DIR__ . "./../vendor/autoload.php";

use App\Core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$base_domain = $_ENV['BASE_DOMAIN'];

$app = new Application(dirname(__DIR__) , $base_domain);


$app->router->get('/', 'home');

$app->router->get('/contact', function() {
    return 'contact us!';
});

$app->router->post('/post-test', function() {
    return 'post!';
});

$app->run();