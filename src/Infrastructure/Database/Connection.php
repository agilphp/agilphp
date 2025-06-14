<?php

namespace App\Infrastructure\Database;

class Connection
{
    private static $pdo;

    public static function getPDO(): \PDO
    {
        if (!self::$pdo) {
            $config = require __DIR__ . '/../../../config/database.php';

            self::$pdo = new \PDO(
                "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']}",
                $config['username'],
                $config['password']
            );

            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }
}
