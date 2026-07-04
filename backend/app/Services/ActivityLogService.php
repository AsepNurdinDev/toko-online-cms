<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class ActivityLogService
{
    public function log(
        int $adminId,
        string $action,
        ?string $description = null
    ): void {
        ActivityLog::create([
            'admin_id'   => $adminId,
            'action'     => $action,
            'description'=> $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}