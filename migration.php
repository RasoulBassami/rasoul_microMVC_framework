<?php
include_once __DIR__ . "/vendor/autoload.php";

use App\Core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$base_domain = $_ENV['BASE_DOMAIN'];


$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'username' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(__DIR__, $base_domain, $config);

$app->db->applyMigrations();