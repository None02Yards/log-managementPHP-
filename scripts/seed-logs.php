<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../bootstrap/autoload.php';

use App\Services\LogSeeder;

$seeder = new LogSeeder();

$result = $seeder->run();

echo "Inserted: {$result['inserted']}\n";
echo "Failed: {$result['failed']}\n";