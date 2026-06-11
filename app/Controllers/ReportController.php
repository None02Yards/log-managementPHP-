<?php
/**
 * Report Controller - Handles report generation and export
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LogModel;
use DateTime;

class ReportController extends Controller
{
    private LogModel $logModel;

    public function __construct()
    {
        parent::__construct();
        $this->logModel = new LogModel();
    }

    /**
     * Display reports page
     */
    public function index()
    {
        $stats = $this->logModel->getStatistics();

        return $this->view('reports/index', [
            'stats' => $stats,
            'page_title' => 'Reports & Analytics',
        ]);
    }

    /**
     * Export logs to JSON
     */
    public function exportJson()
    {
        $filters = $this->getFiltersFromRequest();
        $logs = $this->logModel->getAll($filters, 10000);

        $data = [
            'exported_at' => (new DateTime())->format('Y-m-d H:i:s'),
            'total_entries' => count($logs),
            'filters' => $filters,
            'logs' => $logs,
        ];

        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="logs_' . date('Y-m-d_His') . '.json"');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    /**
     * Export logs to CSV
     */
    public function exportCsv()
    {
        $filters = $this->getFiltersFromRequest();
        $logs = $this->logModel->getAll($filters, 10000);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="logs_' . date('Y-m-d_His') . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Timestamp', 'Severity', 'Source', 'Message', 'Tags', 'Context']);

        foreach ($logs as $log) {
            fputcsv($output, [
                $log['id'],
                $log['timestamp'],
                $log['severity'],
                $log['source'],
                $log['message'],
                $log['tags'],
                $log['context'],
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Export logs to HTML
     */
    public function exportHtml()
    {
        $filters = $this->getFiltersFromRequest();
        $logs = $this->logModel->getAll($filters, 10000);

        $html = $this->view('reports/export-html', [
            'logs' => $logs,
            'exported_at' => (new DateTime())->format('Y-m-d H:i:s'),
        ]);

        header('Content-Type: text/html; charset=utf-8');
        header('Content-Disposition: attachment; filename="logs_' . date('Y-m-d_His') . '.html"');
        echo $html;
        exit;
    }

    /**
     * Get filters from request
     */
    private function getFiltersFromRequest(): array
    {
        return array_filter([
            'severity' => $_GET['severity'] ?? '',
            'source' => $_GET['source'] ?? '',
            'message' => $_GET['message'] ?? '',
            'date_from' => $_GET['date_from'] ?? '',
            'date_to' => $_GET['date_to'] ?? '',
        ]);
    }
}

?>