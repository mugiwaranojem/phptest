<?php

declare(strict_types=1);

namespace App\Utils;

use App\Entity\EntityInterface;

/**
 * Singleton pattern
 * Database connection are meant to be singleton,
 * since the properties/parameters will always be fixed
 */
class Db
{
    private $pdo;

    private static $instance = null;

    private function __construct()
    {
        $dsn = 'mysql:dbname=phptest;host=127.0.0.1';
        $user = 'root';
        $password = 'root';

        $this->pdo = new \PDO($dsn, $user, $password);
    }

    /**
     * Singletons should not be cloneable.
     */
    protected function __clone()
    {
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }

    public function select($sql)
    {
        $sth = $this->pdo->query($sql);
        return $sth->fetchAll();
    }

    /**
     * @Documentation
     * Create resuseable method for insert
     * Using prepared statement to prevent SQL Injection
     */
    public function insert(EntityInterface $entity, array $params): int
    {
        try {
            $prep = [];
            // Define common column property on insert
            $params['created_at'] = date('Y-m-d');

            foreach($params as $key => $value) {
                $prep[':'.$key] = $value;
            }

            $statment = $this->pdo->prepare("INSERT INTO " . $entity->getTableName() . " ( " . implode(', ', array_keys($params)) . ") VALUES (" . implode(', ', array_keys($prep)) . ")");
            $statment->execute($prep);
            return intval($this->pdo->lastInsertId());
        } catch (\Exception $e) {
            // Can use looger to log error message
            exit($e->getMessage());
        }
    }

    /**
     * @Documentation
     * Create resuseable method for delete
     */
    public function delete(EntityInterface $entity)
    {
        $statment = $this->pdo->prepare("DELETE FROM `" . $entity->getTableName() . "` WHERE `id`=:id");
        $statment->execute([
            ':id' => $entity->getId()
        ]);
    }

    public function exec($sql)
    {
        return $this->pdo->exec($sql);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
