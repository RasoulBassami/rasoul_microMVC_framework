<?php

namespace App\Core;

use App\Core\Model;
use App\Core\Application;

abstract class DbModel extends Model
{
    
    abstract static public function tableName ();

    abstract public function attributes ();

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        // INSERT INTO users (firstName, lasstName, ...) VALUES (:firstName, :lasstName, ..);
        $colums = implode(',', $attributes);
        $params = implode(',', array_map(fn($param) => ":$param", $attributes));
        $sql = "INSERT INTO $tableName ($colums) VALUES ($params)";
        $statment = $this->prepare($sql);
        foreach($attributes as $attr) {
            $statment->bindParam(":$attr", $this->{$attr});
        }

        try {
            $statment->execute();
        } catch (\PDOException $e) {
            return false;
        }
        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public function findOne(array $where)
    {
        $tableName = $this->tableName();
        $attributes = array_keys($where);
        // ['firstName' => $firstName, 'email' => $email];
        $condition = implode('AND ', array_map(fn($attr) => "$attr = :$attr" , $attributes));
        $statment = self::prepare("SELECT * FROM $tableName WHERE $condition");
        foreach ($where as $attr => $value) {
            $statment->bindParam(":$attr", $value);
        }
        $statment->execute();
        return $statment->fetchObject(static::class);
    }

}