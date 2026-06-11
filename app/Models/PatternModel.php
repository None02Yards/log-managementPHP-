<?php
/**
 * Pattern Model - Handles log pattern detection and analysis
 */

namespace App\Models;

class PatternModel
{
    private array $patterns = [];

    public function __construct()
    {
        $this->initializePatterns();
    }

    /**
     * Initialize default patterns
     */
    private function initializePatterns(): void
    {
        $this->patterns = [
            'database_error' => [
                'regex' => '/Error|Exception|Fatal|Query|Connection/i',
                'severity' => 'ERROR',
                'description' => 'Database-related errors',
            ],
            'performance_issue' => [
                'regex' => '/slow|timeout|delay|latency|concurrent/i',
                'severity' => 'WARNING',
                'description' => 'Performance degradation issues',
            ],
            'security_threat' => [
                'regex' => '/unauthorized|forbidden|injection|sql|xss|csrf/i',
                'severity' => 'CRITICAL',
                'description' => 'Potential security threats',
            ],
            'authentication_issue' => [
                'regex' => '/login|auth|session|token|unauthorized/i',
                'severity' => 'WARNING',
                'description' => 'Authentication and authorization issues',
            ],
            'resource_exhaustion' => [
                'regex' => '/memory|disk|cpu|resource|out of|limit|exceeded/i',
                'severity' => 'CRITICAL',
                'description' => 'System resource exhaustion',
            ],
            'api_error' => [
                'regex' => '/api|endpoint|request|response|http|status/i',
                'severity' => 'ERROR',
                'description' => 'API-related errors',
            ],
        ];
    }

    /**
     * Detect patterns in log message
     */
    public function detectPatterns(string $message, string $source, array $context = []): array
    {
        $detected = [];
        $fullText = $message . ' ' . $source . ' ' . json_encode($context);

        foreach ($this->patterns as $name => $pattern) {
            if (preg_match($pattern['regex'], $fullText, $matches)) {
                $detected[] = [
                    'pattern' => $name,
                    'description' => $pattern['description'],
                    'suggested_severity' => $pattern['severity'],
                    'matched_text' => $matches[0] ?? '',
                ];
            }
        }

        return $detected;
    }

    /**
     * Get all patterns
     */
    public function getPatterns(): array
    {
        return $this->patterns;
    }

    /**
     * Add custom pattern
     */
    public function addPattern(string $name, string $regex, string $severity, string $description): void
    {
        $this->patterns[$name] = [
            'regex' => $regex,
            'severity' => $severity,
            'description' => $description,
        ];
    }
}

?>