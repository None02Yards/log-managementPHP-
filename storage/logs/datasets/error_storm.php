<?php

$logs = [];

for ($i = 1; $i <= 50; $i++) {

    $logs[] = [
        'severity' => ($i % 5 === 0) ? 'CRITICAL' : 'ERROR',
        'source' => 'api/payment',
        'message' => 'Payment service failure #' . $i
    ];
}

return $logs;