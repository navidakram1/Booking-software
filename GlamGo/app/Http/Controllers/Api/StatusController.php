<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class StatusController extends Controller
{
    /**
     * Get system status information
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            // Check database connection
            $dbStatus = $this->checkDatabaseConnection();
            
            // Check cache connection
            $cacheStatus = $this->checkCacheConnection();
            
            // Get system metrics
            $metrics = $this->getSystemMetrics();

            return response()->json([
                'status' => 'operational',
                'timestamp' => now()->toIso8601String(),
                'services' => [
                    'database' => [
                        'status' => $dbStatus ? 'operational' : 'error',
                        'latency' => $dbStatus ? $this->getDatabaseLatency() : null,
                    ],
                    'cache' => [
                        'status' => $cacheStatus ? 'operational' : 'error',
                    ],
                ],
                'metrics' => $metrics,
                'version' => [
                    'api' => config('app.version', '1.0.0'),
                    'php' => PHP_VERSION,
                    'laravel' => app()->version(),
                ],
                'maintenance_mode' => app()->isDownForMaintenance(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'System status check failed',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
            ], 500);
        }
    }

    /**
     * Check database connection
     *
     * @return bool
     */
    private function checkDatabaseConnection(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check cache connection
     *
     * @return bool
     */
    private function checkCacheConnection(): bool
    {
        try {
            Cache::store()->get('health-check-' . now()->timestamp);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get database query latency
     *
     * @return float
     */
    private function getDatabaseLatency(): float
    {
        $start = microtime(true);
        DB::select('SELECT 1');
        return round((microtime(true) - $start) * 1000, 2); // Return in milliseconds
    }

    /**
     * Get system metrics
     *
     * @return array
     */
    private function getSystemMetrics(): array
    {
        return [
            'memory' => [
                'usage' => memory_get_usage(true),
                'peak' => memory_get_peak_usage(true),
            ],
            'uptime' => [
                'server' => $this->getServerUptime(),
                'php' => time() - $_SERVER['REQUEST_TIME'],
            ],
            'requests' => [
                'total' => $this->getTotalRequests(),
                'per_minute' => $this->getRequestsPerMinute(),
            ],
        ];
    }

    /**
     * Get server uptime in seconds
     *
     * @return int|null
     */
    private function getServerUptime(): ?int
    {
        if (PHP_OS_FAMILY === 'Windows') {
            // Windows uptime via PowerShell
            $uptime = shell_exec('powershell "Get-CimInstance Win32_OperatingSystem | Select-Object LastBootUpTime | Format-Table -HideTableHeaders"');
            if ($uptime) {
                $bootTime = strtotime(trim($uptime));
                return time() - $bootTime;
            }
        } else {
            // Linux uptime
            $uptime = shell_exec('cat /proc/uptime');
            if ($uptime) {
                return (int)explode(' ', $uptime)[0];
            }
        }
        return null;
    }

    /**
     * Get total requests (dummy data for demo)
     *
     * @return int
     */
    private function getTotalRequests(): int
    {
        return Cache::remember('total_requests', 60, function () {
            return rand(10000, 50000);
        });
    }

    /**
     * Get requests per minute (dummy data for demo)
     *
     * @return int
     */
    private function getRequestsPerMinute(): int
    {
        return Cache::remember('requests_per_minute', 60, function () {
            return rand(100, 500);
        });
    }
}
