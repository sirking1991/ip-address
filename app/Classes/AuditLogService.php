<?php

namespace App\Classes;

use App\Models\AuditLog;

class AuditLogService {

    /** 
     * returns list of recorded audit logs
     */
    public static function list($ip)
    {
        $return = AuditLog::with('user')->where('ip', $ip)->get();
        return $return;
    }

    public static function log($ip, $userId, $remarks) {
        AuditLog::create([
            'ip' => $ip,
            'user_id' => $userId,
            'remarks' => $remarks
        ]);
    }

}