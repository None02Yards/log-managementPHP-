<?php

return [

    [
        'severity' => 'INFO',
        'source' => 'api/auth',
        'message' => 'User authenticated successfully'
    ],

    [
        'severity' => 'INFO',
        'source' => 'db/connection',
        'message' => 'Database connection established'
    ],

    [
        'severity' => 'WARNING',
        'source' => 'db/query',
        'message' => 'Slow query execution detected'
    ],

    [
        'severity' => 'ERROR',
        'source' => 'api/payment',
        'message' => 'Payment gateway timeout'
    ],

    [
        'severity' => 'CRITICAL',
        'source' => 'security/firewall',
        'message' => 'SQL injection attack detected'
    ]

];