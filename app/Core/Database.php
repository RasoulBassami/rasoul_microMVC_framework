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

    public function applyMigrations()
    {
        $newMigrations = [];

        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $migrationFiles = scandir(Application::$ROOT_DIR . '/app/Migrations');
        $readyToApply = array_diff($migrationFiles, $appliedMigrations);
        
        foreach($readyToApply as $migration) {
            if($migration == '.' or $migration == '..') {
                continue;
            }
            include_once Application::$ROOT_DIR . '/app/Migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);

            echo "$className: ";
            $instance = new $className();
            $instance->up();

            $newMigrations[] = $migration;
        }

        if(!empty($newMigrations)) {
            $this->saveNewMigrations($newMigrations);
            echo "Done!";
        } else {
            echo "All migration are already applied.";
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS `migrations` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `migration` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=INNODB;');
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare('SELECT `migration` FROM `migrations`');
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveNewMigrations($migrations)
    {
        $values = implode(',', (array_map(fn($m) => "('$m')" , $migrations)));
        $sql = "INSERT INTO `migrations` (`migration`) VALUES $values";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }
}