<?php

namespace App\Core;
use App\Core\Exceptions\ConnectionToDatabase;


class Database {

    public $pdo;
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';

        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch(\PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
            throw new ConnectionToDatabase();
        }
    }

}