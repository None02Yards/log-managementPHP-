<?php

namespace App\Services;

use App\Models\LogModel;

class LogSeeder
{
    public function run(): array
    {
        $logModel = new LogModel();

        $sampleLogs = [
            [
                'severity' => 'INFO',
                'message' => 'Application started successfully',
                'source' => 'app/bootstrap',
                'context' => ['version' => '1.0.0'],
                'tags' => ['startup']
            ],

            // ...rest of logs
        ];

        $inserted = 0;
        $failed = 0;

        foreach ($sampleLogs as $index => $logData) {

            $entry = [
                'id' => uniqid('log_', true),
                'timestamp' => date('Y-m-d H:i:s', strtotime("-{$index} minutes")),
                'severity' => $logData['severity'],
                'message' => $logData['message'],
                'source' => $logData['source'],
                'context' => $logData['context'],
                'tags' => $logData['tags'],
            ];

            if ($logModel->insert($entry)) {
                $inserted++;
            } else {
                $failed++;
            }
        }

        return [
            'inserted' => $inserted,
            'failed' => $failed,
            'stats' => $logModel->getStatistics(),
        ];
    }
}