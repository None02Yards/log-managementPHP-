<?php

return [

    ['severity'=>'WARNING','source'=>'security/firewall','message'=>'Repeated login failures detected'],
    ['severity'=>'WARNING','source'=>'security/firewall','message'=>'Suspicious IP reputation detected'],
    ['severity'=>'WARNING','source'=>'api/auth','message'=>'Multiple password reset attempts'],

    ['severity'=>'ERROR','source'=>'security/firewall','message'=>'Blocked malicious payload'],
    ['severity'=>'ERROR','source'=>'security/firewall','message'=>'Cross-site scripting attempt detected'],
    ['severity'=>'ERROR','source'=>'security/firewall','message'=>'Directory traversal attempt detected'],
    ['severity'=>'ERROR','source'=>'api/auth','message'=>'Account lockout triggered'],
    ['severity'=>'ERROR','source'=>'security/firewall','message'=>'Bot activity detected'],

    ['severity'=>'CRITICAL','source'=>'security/firewall','message'=>'SQL injection attack detected'],
    ['severity'=>'CRITICAL','source'=>'security/firewall','message'=>'Credential stuffing attack detected'],
    ['severity'=>'CRITICAL','source'=>'security/firewall','message'=>'Privilege escalation attempt detected'],
    ['severity'=>'CRITICAL','source'=>'security/firewall','message'=>'Unauthorized admin access attempt'],
    ['severity'=>'CRITICAL','source'=>'security/firewall','message'=>'Sensitive data exfiltration suspected'],

];