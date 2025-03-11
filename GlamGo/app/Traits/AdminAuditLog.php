<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

trait AdminAuditLog
{
    /**
     * Log an admin activity with detailed information
     */
    protected function logAdminActivity(
        string $action,
        string $module,
        ?string $description = null,
        ?array $data = null,
        string $level = 'info'
    ): void {
        $admin = Auth::guard('admin')->user();
        
        $logData = [
            'admin_id' => $admin?->id,
            'admin_email' => $admin?->email,
            'admin_role' => $admin?->role,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'module' => $module,
            'action' => $action,
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'timestamp' => now()->toIso8601String(),
        ];

        if ($description) {
            $logData['description'] = $description;
        }

        if ($data) {
            $logData['data'] = $data;
        }

        // Log with appropriate level
        Log::channel('admin_audit')->$level(
            "{$module}: {$action}" . ($description ? " - {$description}" : ''),
            $logData
        );
    }

    /**
     * Log a security event
     */
    protected function logSecurityEvent(
        string $event,
        string $status,
        ?string $description = null,
        ?array $data = null
    ): void {
        $this->logAdminActivity(
            $event,
            'security',
            $description,
            $data,
            $status === 'success' ? 'info' : 'warning'
        );
    }

    /**
     * Log an access attempt
     */
    protected function logAccessAttempt(
        string $module,
        string $action,
        bool $success,
        ?string $reason = null
    ): void {
        $status = $success ? 'success' : 'failure';
        $description = $success 
            ? "Successful access to {$module}" 
            : "Access denied to {$module}" . ($reason ? ": {$reason}" : '');

        $this->logSecurityEvent(
            'access_attempt',
            $status,
            $description,
            [
                'module' => $module,
                'action' => $action,
                'success' => $success,
                'reason' => $reason
            ]
        );
    }
} 