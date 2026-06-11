<?php
/**
 * SQLite Database Connection Helper
 * No external database required - uses local SQLite file
 */


class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct()
    {
        try {
            $dbPath = LOGS_PATH . '/logs.db';
            
            $this->connection = new PDO(
                'sqlite:' . $dbPath,
                null,
                null,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
            
            // Enable foreign keys
            $this->connection->exec('PRAGMA foreign_keys = ON');
            
            // Initialize database
            $this->initializeDatabase();
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            die('Database connection error: ' . $e->getMessage());
        }
    }

    private function initializeDatabase(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS logs (
                id TEXT PRIMARY KEY,
                timestamp TEXT DEFAULT CURRENT_TIMESTAMP,
                severity TEXT NOT NULL,
                message TEXT NOT NULL,
                source TEXT NOT NULL,
                context TEXT,
                tags TEXT,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );
            
            CREATE INDEX IF NOT EXISTS idx_severity ON logs(severity);
            CREATE INDEX IF NOT EXISTS idx_source ON logs(source);
            CREATE INDEX IF NOT EXISTS idx_timestamp ON logs(timestamp);
        ";
        
        try {
            $this->connection->exec($sql);
        } catch (PDOException $e) {
            error_log('Database initialization error: ' . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    private function __clone() {}
    
    public function __wakeup(): void
    {
        throw new Exception("Cannot unserialize Database");
    }
}

?>
