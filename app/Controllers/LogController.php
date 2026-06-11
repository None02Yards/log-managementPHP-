<?php
/**
 * Log Controller - Handles log operations
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LogModel;
use App\Models\PatternModel;
use DateTime;

class LogController extends Controller
{
    private LogModel $logModel;
    private PatternModel $patternModel;

    public function __construct()
    {
        parent::__construct();
        $this->logModel = new LogModel();
        $this->patternModel = new PatternModel();
    }

    /**
     * Display dashboard
     */
public function dashboard()
{
    $stats = $this->logModel->getStatistics();
    $recentLogs = $this->logModel->getRecent(10); // <-- missing in many setups

    return $this->view('dashboard', [
        'stats' => $stats,
        'recentLogs' => $recentLogs
    ]);
}

    /**
     * Display all logs
     */
    public function index()
    {
        $page = $_GET['page'] ?? 1;
        $severity = $_GET['severity'] ?? '';
        $source = $_GET['source'] ?? '';
        $message = $_GET['message'] ?? '';
        $date_from = $_GET['date_from'] ?? '';
        $date_to = $_GET['date_to'] ?? '';

        $filters = array_filter([
            'severity' => $severity,
            'source' => $source,
            'message' => $message,
            'date_from' => $date_from,
            'date_to' => $date_to,
        ]);

        $limit = 50;
        $offset = ($page - 1) * $limit;
        $logs = $this->logModel->getAll($filters, $limit, $offset);

        return $this->view('logs/index', [
            'logs' => $logs,
            'filters' => $filters,
            'page' => $page,
            'page_title' => 'All Logs',
        ]);
    }

    /**
     * Display single log
     */
    public function show(string $id)
    {
        $log = $this->logModel->getById($id);

        if (!$log) {
            http_response_code(404);
            return $this->view('errors/404');
        }

        // Detect patterns
        $patterns = $this->patternModel->detectPatterns(
            $log['message'],
            $log['source'],
            json_decode($log['context'] ?? '[]', true)
        );

        return $this->view('logs/show', [
            'log' => $log,
            'patterns' => $patterns,
            'page_title' => 'Log Details',
        ]);
    }

    /**
     * Create new log (API)
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json(['error' => 'Method not allowed'], 405);
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['severity'], $input['message'], $input['source'])) {
            return $this->json(['error' => 'Missing required fields'], 400);
        }

        $logData = [
            'id' => uniqid('log_', true),
            'timestamp' => (new DateTime())->format('Y-m-d H:i:s.u'),
            'severity' => $input['severity'],
            'message' => $input['message'],
            'source' => $input['source'],
            'context' => $input['context'] ?? [],
            'tags' => $input['tags'] ?? [],
        ];

        if ($this->logModel->insert($logData)) {
            return $this->json(['success' => true, 'id' => $logData['id']], 201);
        }

        return $this->json(['error' => 'Failed to create log'], 500);
    }

    /**
     * Delete log
     */
    public function delete(string $id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json(['error' => 'Method not allowed'], 405);
        }

        if ($this->logModel->delete($id)) {
            return $this->json(['success' => true, 'message' => 'Log deleted']);
        }

        return $this->json(['error' => 'Failed to delete log'], 500);
    }

    /**
     * Search logs
     */
    public function search()
    {
        $query = $_GET['q'] ?? '';
        $severity = $_GET['severity'] ?? '';
        $source = $_GET['source'] ?? '';

        $filters = array_filter([
            'message' => $query,
            'severity' => $severity,
            'source' => $source,
        ]);

        $results = $this->logModel->getAll($filters, 100);

        return $this->json([
            'query' => $query,
            'results' => $results,
            'count' => count($results),
        ]);
    }
}

?>