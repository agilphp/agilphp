<?php

namespace App\Infrastructure\Database\Migrations;

use App\Infrastructure\Database\Connection;

class CreateUsersTable
{
    public static function up()
    {
        $pdo = Connection::getPDO();

        $query = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";

        $pdo->exec($query);
    }
}
