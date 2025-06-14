<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Infrastructure/Database/Migrations/CreateUsersTable.php';

use App\Infrastructure\Database\Migrations\CreateUsersTable;

CreateUsersTable::up();

echo "Migration executed successfully.\n";
