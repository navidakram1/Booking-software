<?php

namespace App\Traits;

use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsAdminActivity
{
    /**
     * Log an admin activity
     *
     * @param string $action
     * @param string $description
     * @param string $status
     * @param array|null $metadata
     * @return AdminActivityLog
     */
    protected function logAdminActivity(
        string $action,
        string $description,
        string $status = 'success',
        ?array $metadata = null
    ): AdminActivityLog {
        return AdminActivityLog::create([
            'admin_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'status' => $status,
            'metadata' => $metadata
        ]);
    }
} 