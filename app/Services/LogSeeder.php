<?php

namespace App\Services;

use App\Models\LogModel;

class LogSeeder
{
    public function run(string $dataset = 'demo_50'): array
    {
        $logModel = new LogModel();

        $datasetPath =
            dirname(__DIR__, 2)
            . '/storage/datasets/'
            . $dataset
            . '.php';

        if (!file_exists($datasetPath)) {

            return [
                'inserted' => 0,
                'failed' => 0,
                'error' => "Dataset '{$dataset}' not found."
            ];
        }

        $sampleLogs = require $datasetPath;


        $inserted = 0;
        $failed = 0;

        foreach ($sampleLogs as $index => $logData) {

            $entry = [

                'id' => uniqid('log_', true),

                'timestamp' => date(
                    'Y-m-d H:i:s',
                    strtotime("-{$index} minutes")
                ),

                'severity' => $logData['severity'],

                'message' => $logData['message'],

                'source' => $logData['source'],

                'context' => $logData['context'] ?? [],

                'tags' => $logData['tags'] ?? [],
            ];

            if ($logModel->insert($entry)) {
                $inserted++;
            } else {
                $failed++;
            }
        }

        return [
            'dataset' => $dataset,
            'inserted' => $inserted,
            'failed' => $failed,
            'stats' => $logModel->getStatistics(),
        ];
    }
}