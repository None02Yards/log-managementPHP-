<?php

return [

    // INFO

    ['severity'=>'INFO','source'=>'api/auth','message'=>'User authenticated successfully'],
    ['severity'=>'INFO','source'=>'api/auth','message'=>'Session token generated'],
    ['severity'=>'INFO','source'=>'api/auth','message'=>'Password reset email sent'],
    ['severity'=>'INFO','source'=>'api/users','message'=>'User profile updated'],
    ['severity'=>'INFO','source'=>'api/users','message'=>'New account registered'],

    ['severity'=>'INFO','source'=>'db/connection','message'=>'Database connection established'],
    ['severity'=>'INFO','source'=>'db/query','message'=>'Customer records retrieved'],
    ['severity'=>'INFO','source'=>'db/query','message'=>'Monthly report generated'],
    ['severity'=>'INFO','source'=>'cache/redis','message'=>'Cache warmed successfully'],
    ['severity'=>'INFO','source'=>'cache/redis','message'=>'Session cache refreshed'],

    ['severity'=>'INFO','source'=>'scheduler/jobs','message'=>'Nightly cleanup completed'],
    ['severity'=>'INFO','source'=>'scheduler/jobs','message'=>'Email queue processed'],
    ['severity'=>'INFO','source'=>'email/service','message'=>'Welcome email delivered'],
    ['severity'=>'INFO','source'=>'email/service','message'=>'Invoice email delivered'],
    ['severity'=>'INFO','source'=>'storage/files','message'=>'Document uploaded successfully'],

    ['severity'=>'INFO','source'=>'storage/files','message'=>'Backup completed'],
    ['severity'=>'INFO','source'=>'api/payment','message'=>'Payment processed'],
    ['severity'=>'INFO','source'=>'api/payment','message'=>'Refund processed'],
    ['severity'=>'INFO','source'=>'system/kernel','message'=>'System startup completed'],
    ['severity'=>'INFO','source'=>'system/kernel','message'=>'Background services initialized'],

    ['severity'=>'INFO','source'=>'api/orders','message'=>'Order created'],
    ['severity'=>'INFO','source'=>'api/orders','message'=>'Order fulfilled'],
    ['severity'=>'INFO','source'=>'api/orders','message'=>'Order shipment updated'],
    ['severity'=>'INFO','source'=>'api/inventory','message'=>'Inventory synchronized'],
    ['severity'=>'INFO','source'=>'api/inventory','message'=>'Stock count refreshed'],

    // WARNING

    ['severity'=>'WARNING','source'=>'db/query','message'=>'Slow query execution detected'],
    ['severity'=>'WARNING','source'=>'cache/redis','message'=>'Cache miss threshold exceeded'],
    ['severity'=>'WARNING','source'=>'api/payment','message'=>'Gateway response delayed'],
    ['severity'=>'WARNING','source'=>'scheduler/jobs','message'=>'Job execution running longer than expected'],
    ['severity'=>'WARNING','source'=>'storage/files','message'=>'Large upload detected'],

    ['severity'=>'WARNING','source'=>'email/service','message'=>'Email retry queue growing'],
    ['severity'=>'WARNING','source'=>'system/kernel','message'=>'Memory usage exceeded 75 percent'],
    ['severity'=>'WARNING','source'=>'api/auth','message'=>'Multiple failed login attempts detected'],
    ['severity'=>'WARNING','source'=>'db/connection','message'=>'Connection pool usage high'],
    ['severity'=>'WARNING','source'=>'api/orders','message'=>'Order processing latency increasing'],

    // ERROR

    ['severity'=>'ERROR','source'=>'api/payment','message'=>'Payment gateway timeout'],
    ['severity'=>'ERROR','source'=>'db/connection','message'=>'Temporary database disconnect'],
    ['severity'=>'ERROR','source'=>'email/service','message'=>'SMTP connection failed'],
    ['severity'=>'ERROR','source'=>'storage/files','message'=>'File upload validation failed'],
    ['severity'=>'ERROR','source'=>'api/auth','message'=>'OAuth provider unavailable'],

    ['severity'=>'ERROR','source'=>'scheduler/jobs','message'=>'Scheduled task execution failed'],
    ['severity'=>'ERROR','source'=>'api/orders','message'=>'Order processing exception'],
    ['severity'=>'ERROR','source'=>'cache/redis','message'=>'Cache write failed'],
    ['severity'=>'ERROR','source'=>'system/kernel','message'=>'Unexpected service restart'],
    ['severity'=>'ERROR','source'=>'db/query','message'=>'Query execution timeout'],

    // CRITICAL

    ['severity'=>'CRITICAL','source'=>'security/firewall','message'=>'SQL injection attempt detected'],
    ['severity'=>'CRITICAL','source'=>'security/firewall','message'=>'Brute force attack threshold exceeded'],
    ['severity'=>'CRITICAL','source'=>'api/payment','message'=>'Transaction service unavailable'],
    ['severity'=>'CRITICAL','source'=>'db/connection','message'=>'Database unreachable'],
    ['severity'=>'CRITICAL','source'=>'system/kernel','message'=>'Disk space critically low']

];