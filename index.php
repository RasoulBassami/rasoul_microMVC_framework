<?php
include_once __DIR__ . "/vendor/autoload.php";

use App\Core\Application;

$app = new Application();

$app->router->get('/', function() {
    return 'home';
});

$app->router->get('/contact', function() {
    return 'contact us!';
});

$app->router->post('/post-test', function() {
    return 'post!';
});

$app->run();