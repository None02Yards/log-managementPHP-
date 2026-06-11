<!-- E:\centralized-log-management\public\index.php -->
<?php
/**
 * Application Entry Point
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once dirname(dirname(__FILE__)) . '/config/config.php';
require_once dirname(dirname(__FILE__)) . '/config/database.php';
define('APP_PATH', dirname(__DIR__) . '/app');
define('VIEWS_PATH', APP_PATH . '/views');

// Autoload classes
spl_autoload_register(function ($class) {

    $prefix = 'App\\';

    if (strpos($class, $prefix) === 0) {
        $class = substr($class, strlen($prefix));
    }

    $path = str_replace('\\', '/', $class);
    $file = APP_PATH . '/' . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\Router;
use App\Core\View;

// Initialize router
$router = new Router();
$router->post(
    'api/seed',
    'SeederController',
    'run'
);

// Define routes
$router->get('/', 'HomeController', 'index');

$router->get('dashboard', 'LogController', 'dashboard');

$router->get('logs', 'LogController', 'index');
$router->get('logs/{id}', 'LogController', 'show');
$router->post('logs', 'LogController', 'create');
$router->post('logs/{id}', 'LogController', 'delete');
$router->get('reports', 'ReportController', 'index');
$router->get('reports/export-json', 'ReportController', 'exportJson');
$router->get('reports/export-csv', 'ReportController', 'exportCsv');
$router->get('reports/export-html', 'ReportController', 'exportHtml');

// API routes
$router->get('api/logs', 'ApiController', 'getLogs');
$router->get('api/logs/{id}', 'ApiController', 'getLog');
$router->post('api/logs', 'ApiController', 'createLog');
$router->get('api/stats', 'ApiController', 'getStats');

$router->get('api/health', 'ApiController', 'health');
$router->get('api/snapshot', 'ApiController', 'snapshot');
$router->get('api/history', 'ApiController', 'history');

$router->post('api/simulate', 'SeederController', 'simulateIncident');
$router->post('api/simulator/start', 'SeederController', 'startSimulator');
$router->post('api/simulator/stop', 'SeederController', 'stopSimulator');
$router->post(
    'api/simulate',
    'SeederController',
    'simulateIncident'
);

// Dispatch the request
echo $router->dispatch();
?>