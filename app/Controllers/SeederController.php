<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\LogSeeder;

class SeederController extends Controller
{
    public function run()
    {
        header('Content-Type: application/json');

        $seeder = new LogSeeder();

        // echo json_encode([
        //     'success' => true,
        //     'result' => $seeder->run()
        // ]);

        return $this->json([
            'success' => true,
            'result' => $seeder->run()
        ]);
    }

    public function simulateIncident()
    {
        $type = $_POST['type'] ?? '';

        switch ($type) {

            case 'api_outage':

                $logs = [
                    'ERROR API Gateway Timeout',
                    'ERROR Service Unavailable',
                    'CRITICAL Upstream Connection Lost'
                ];

                break;

            case 'db_failure':

                $logs = [
                    'WARNING Slow Query',
                    'ERROR Connection Pool Exhausted',
                    'CRITICAL Database Unreachable'
                ];

                break;

            default:

                $logs = [
                    'INFO Incident simulation started'
                ];
        }

        return $this->json([
            'success' => true,
            'logs' => $logs
        ]);
    }
} 