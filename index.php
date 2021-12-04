<?php
include_once __DIR__ . "/vendor/autoload.php";

use App\Core\Application;

$app = new Application();

$app->router->get('/', function() {
    echo 'home';
});

$app->router->get('/contact', function() {
    echo 'contact us!';
});

$app->router->post('/post-test', function() {
    echo 'post!';
});

$app->run();