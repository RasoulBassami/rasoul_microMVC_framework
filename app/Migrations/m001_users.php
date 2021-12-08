<?php

use App\Core\Application;

class m001_users {

    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec('CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(255) NOT NULL,
            `firstName` varchar(255) NOT NULL,
            `lastName` varchar(255) NOT NULL,
            `status` tinyint NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=INNODB;');
    }

    public function dowm()
    {
        $db = Application::$app->db;
        $db->pdo->exec('DROP TABLE `users`;');
    }
}