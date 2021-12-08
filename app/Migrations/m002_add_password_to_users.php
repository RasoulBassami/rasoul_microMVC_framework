<?php

use App\Core\Application;

class m002_add_password_to_users {

    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec('ALTER TABLE `users` ADD `password` varchar(512) NOT NULL;');
    }

    public function dowm()
    {
        $db = Application::$app->db;
        $db->pdo->exec('ALTER TABLE `users` DROP COLUMN `password`;');
    }
}