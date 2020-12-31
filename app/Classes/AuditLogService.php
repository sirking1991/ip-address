<?php

namespace App\Classes;

use App\Models\AuditLog;

class AuditLogService {

    public static function log($ip, $userId, $remarks) {
        AuditLog::create([
            'ip' => $ip,
            'user_id' => $userId,
            'remarks' => $remarks
        ]);
    }

}