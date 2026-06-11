<?php
/**
 * Application Configuration
 * Central configuration file for the logging system
 */

define('APP_NAME', 'Centralized Log Management System');
define('APP_VERSION', '1.0.0');
define('APP_ENV', getenv('APP_ENV') ?? 'development');
define('BASE_URL', '/');
// Database Configuration (SQLite - No setup needed!)
define('DB_TYPE', 'sqlite');  // No need for DB_HOST, DB_USER, DB_PASS

// File Paths
define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_PATH', BASE_PATH . '/app');
define('LOGS_PATH', BASE_PATH . '/storage/logs');
define('VIEWS_PATH', BASE_PATH . '/app/views');
define('PUBLIC_PATH', BASE_PATH . '/public');
define('ROOT_PATH', dirname(__DIR__));

// Timezone
date_default_timezone_set('UTC');

// Error Handling
if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', 0);
}

// Session Configuration
session_start();
if (php_sapi_name() !== 'cli') {

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
    ]);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
// Create necessary directories
$directories = [LOGS_PATH, LOGS_PATH . '/entries', VIEWS_PATH];
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

?>
