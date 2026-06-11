<?php
/**
 * Log Model - Database operations for logs (SQLite compatible)
 */

namespace App\Models;

use PDO;

class LogModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = \Database::getInstance()->getConnection();
    }

    /**
     * Get all logs with optional filtering
     */
    public function getAll(array $filters = [], int $limit = 100, int $offset = 0): array
    {
        $sql = 'SELECT * FROM logs WHERE 1=1';
        $params = [];

        if (!empty($filters['severity'])) {
            $sql .= ' AND severity = :severity';
            $params[':severity'] = $filters['severity'];
        }

        if (!empty($filters['source'])) {
            $sql .= ' AND source LIKE :source';
            $params[':source'] = '%' . $filters['source'] . '%';
        }

        if (!empty($filters['message'])) {
            $sql .= ' AND message LIKE :message';
            $params[':message'] = '%' . $filters['message'] . '%';
        }

        if (!empty($filters['date_from'])) {
            $sql .= ' AND timestamp >= :date_from';
            $params[':date_from'] = $filters['date_from'];
        }

        if (!empty($filters['date_to'])) {
            $sql .= ' AND timestamp <= :date_to';
            $params[':date_to'] = $filters['date_to'];
        }

        $sql .= ' ORDER BY timestamp DESC LIMIT :limit OFFSET :offset';
        $params[':limit'] = $limit;
        $params[':offset'] = $offset;

        try {
            $stmt = $this->db->prepare($sql);
            foreach ($params as $key => $value) {
                if (strpos($key, 'limit') !== false || strpos($key, 'offset') !== false) {
                    $stmt->bindValue($key, $value, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue($key, $value);
                }
            }
            $stmt->execute();
            return $stmt->fetchAll() ?: [];
        } catch (\Exception $e) {
            error_log('Fetch error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get log by ID
     */
    public function getById(string $id): ?array
    {
        $sql = 'SELECT * FROM logs WHERE id = :id';
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetch();
            return $result ?: null;
        } catch (\Exception $e) {
            error_log('Fetch error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Insert a log entry
     */
    public function insert(array $data): bool
    {
        $sql = "
            INSERT INTO logs (id, timestamp, severity, message, source, context, tags)
            VALUES (:id, :timestamp, :severity, :message, :source, :context, :tags)
        ";

        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id' => $data['id'],
                ':timestamp' => $data['timestamp'],
                ':severity' => $data['severity'],
                ':message' => $data['message'],
                ':source' => $data['source'],
                ':context' => json_encode($data['context'] ?? []),
                ':tags' => json_encode($data['tags'] ?? []),
            ]);
        } catch (\Exception $e) {
            error_log('Insert error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get statistics
     */
    public function getStatistics(): array
    {
        $stats = [];

        try {
            // Total logs
            $sql = 'SELECT COUNT(*) as total FROM logs';
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch();
            $stats['total'] = $result['total'] ?? 0;

            // By severity
            $sql = 'SELECT severity, COUNT(*) as count FROM logs GROUP BY severity ORDER BY count DESC';
            $stmt = $this->db->query($sql);
            $stats['by_severity'] = $stmt->fetchAll() ?: [];

            // By source
            $sql = 'SELECT source, COUNT(*) as count FROM logs GROUP BY source ORDER BY count DESC LIMIT 10';
            $stmt = $this->db->query($sql);
            $stats['by_source'] = $stmt->fetchAll() ?: [];

            return $stats;
        } catch (\Exception $e) {
            error_log('Stats error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Delete log by ID
     */
    public function delete(string $id): bool
    {
        $sql = 'DELETE FROM logs WHERE id = :id';
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (\Exception $e) {
            error_log('Delete error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Clear all logs older than days
     */
    public function clearOldLogs(int $days = 30): bool
    {
        $sql = "DELETE FROM logs WHERE created_at < datetime('now', '-' || :days || ' days')";
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':days' => $days]);
        } catch (\Exception $e) {
            error_log('Clear error: ' . $e->getMessage());
            return false;
        }
    }

    public function getRecent($limit = 10)
{
    $stmt = $this->db->prepare("
        SELECT * FROM logs
        ORDER BY timestamp DESC
        LIMIT :limit
    ");

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    /**
     * @param array{
     *   severity?: string,
     *   source?: string,
     *   limit?: int
     * } $filters
     * @return array
     */
    public function getFiltered(array $filters): array
    {

        $sql = "SELECT * FROM logs WHERE 1=1";
        $params = [];

        if (!empty($filters['severity'])) {
            $sql .= " AND severity = :severity";
            $params[':severity'] = $filters['severity'];
        }

        if (!empty($filters['source'])) {
            $sql .= " AND source = :source";
            $params[':source'] = $filters['source'];
        }

        $sql .= " ORDER BY timestamp DESC LIMIT 50";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>
