<?php
/**
 * API Controller - REST API endpoints
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LogModel;

class ApiController extends Controller
{
    private LogModel $logModel;

    public function __construct()
    {
        parent::__construct();
        $this->logModel = new LogModel();
        header('Content-Type: application/json');
    }

    /**
     * Get all logs (API)
     */
public function getLogs()
{
    header('Content-Type: application/json');

    $model = new \App\Models\LogModel();

    $filters = [
        'severity' => $_GET['severity'] ?? null,
        'source'   => $_GET['source'] ?? null,
        'limit'    => 50
    ];

    $logs = $model->getFiltered($filters);

    echo json_encode([
        'success' => true,
        'data' => $logs
    ]);
}
    /**
     * Get single log (API)
     */
    public function getLog(string $id)
    {
        $log = $this->logModel->getById($id);

        if (!$log) {
            return $this->json(['error' => 'Log not found'], 404);
        }

        return $this->json(['success' => true, 'data' => $log]);
    }

    /**
     * Create log (API)
     */
    public function createLog()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json(['error' => 'Method not allowed'], 405);
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['severity'], $input['message'], $input['source'])) {
            return $this->json(['error' => 'Missing required fields: severity, message, source'], 400);
        }

        $logData = [
            'id' => uniqid('log_', true),
            'timestamp' => date('Y-m-d H:i:s'),
            'severity' => $input['severity'],
            'message' => $input['message'],
            'source' => $input['source'],
            'context' => $input['context'] ?? [],
            'tags' => $input['tags'] ?? [],
        ];

        if ($this->logModel->insert($logData)) {
            return $this->json([
                'success' => true,
                'message' => 'Log created',
                'id' => $logData['id'],
            ], 201);
        }

        return $this->json(['error' => 'Failed to create log'], 500);
    }

    /**
     * Get statistics (API)
     */
    public function getStats()
    {
        $stats = $this->logModel->getStatistics();
        return $this->json(['success' => true, 'data' => $stats]);
    }

    public function health()
    {
        return $this->json([
            'database' => true,
            'seeder_api' => true,
            'log_model' => true,
            'patterns' => true
        ]);
    }

    public function history()
    {
        return $this->json([
            [
                'time' => '2026-06-11 14:55',
                'inserted' => 1000,
                'preset' => 'Demo Dataset'
            ],
            [
                'time' => '2026-06-11 14:20',
                'inserted' => 500,
                'preset' => 'Error Storm'
            ]
        ]);
  
     }

    public function snapshot()
    {
        return $this->json([
            'logs' => 14223,
            'sources' => 8,
            'patterns' => 51,
            'reports' => 12
        ]);
    }
}

?>