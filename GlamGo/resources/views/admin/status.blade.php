@extends('layouts.main')

@section('title', 'System Status - GlamGo')

@push('styles')
<style>
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    .status-pulse {
        animation: pulse 2s infinite;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-pink-50/30 to-purple-50/30 py-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <span class="bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    System Status
                </span>
            </h1>
            <p class="text-lg text-gray-600" id="lastUpdated">Last updated: Checking...</p>
        </div>

        <!-- Overall Status -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800" id="overallStatus">Checking System Status...</h2>
                    <p class="text-gray-600 mt-2" id="maintenanceStatus">Checking maintenance status...</p>
                </div>
                <div id="statusIndicator" class="w-12 h-12 rounded-full flex items-center justify-center status-pulse">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Database Status -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Database</h3>
                    <div id="dbStatus" class="px-4 py-2 rounded-full text-sm font-semibold">Checking...</div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Latency</span>
                        <span id="dbLatency" class="font-bold text-gray-800">Checking...</span>
                    </div>
                </div>
            </div>

            <!-- Cache Status -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Cache</h3>
                    <div id="cacheStatus" class="px-4 py-2 rounded-full text-sm font-semibold">Checking...</div>
                </div>
            </div>
        </div>

        <!-- Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Memory Usage -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Memory Usage</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600">Current</p>
                        <p id="memoryUsage" class="text-2xl font-bold text-gray-800">Checking...</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Peak</p>
                        <p id="memoryPeak" class="text-2xl font-bold text-gray-800">Checking...</p>
                    </div>
                </div>
            </div>

            <!-- Uptime -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Uptime</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600">Server</p>
                        <p id="serverUptime" class="text-2xl font-bold text-gray-800">Checking...</p>
                    </div>
                    <div>
                        <p class="text-gray-600">PHP</p>
                        <p id="phpUptime" class="text-2xl font-bold text-gray-800">Checking...</p>
                    </div>
                </div>
            </div>

            <!-- Requests -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Requests</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600">Total</p>
                        <p id="totalRequests" class="text-2xl font-bold text-gray-800">Checking...</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Per Minute</p>
                        <p id="requestsPerMinute" class="text-2xl font-bold text-gray-800">Checking...</p>
                    </div>
                </div>
            </div>

            <!-- Version Info -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Version Info</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600">API</p>
                        <p id="apiVersion" class="text-2xl font-bold text-gray-800">Checking...</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Laravel</p>
                        <p id="laravelVersion" class="text-2xl font-bold text-gray-800">Checking...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Refresh Button -->
        <div class="text-center">
            <button onclick="fetchStatus()" class="px-8 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold hover:from-pink-600 hover:to-purple-700 transition-all duration-300 shadow-lg">
                Refresh Status
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function formatBytes(bytes) {
    const sizes = ['B', 'KB', 'MB', 'GB'];
    if (bytes === 0) return '0 B';
    const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

function formatUptime(seconds) {
    const days = Math.floor(seconds / 86400);
    const hours = Math.floor((seconds % 86400) / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    
    let uptime = '';
    if (days > 0) uptime += `${days}d `;
    if (hours > 0) uptime += `${hours}h `;
    uptime += `${minutes}m`;
    return uptime;
}

function updateUI(data) {
    // Update timestamp
    document.getElementById('lastUpdated').textContent = `Last updated: ${new Date().toLocaleString()}`;

    // Update overall status
    const statusIndicator = document.getElementById('statusIndicator');
    if (data.status === 'operational') {
        document.getElementById('overallStatus').textContent = 'All Systems Operational';
        statusIndicator.className = 'w-12 h-12 rounded-full flex items-center justify-center status-pulse text-green-500';
    } else {
        document.getElementById('overallStatus').textContent = 'System Issues Detected';
        statusIndicator.className = 'w-12 h-12 rounded-full flex items-center justify-center status-pulse text-red-500';
    }

    // Update maintenance status
    document.getElementById('maintenanceStatus').textContent = 
        data.maintenance_mode ? 'System is in maintenance mode' : 'System is active';

    // Update database status
    const dbStatus = document.getElementById('dbStatus');
    if (data.services.database.status === 'operational') {
        dbStatus.textContent = 'Operational';
        dbStatus.className = 'px-4 py-2 bg-green-100 text-green-600 rounded-full text-sm font-semibold';
    } else {
        dbStatus.textContent = 'Error';
        dbStatus.className = 'px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm font-semibold';
    }
    document.getElementById('dbLatency').textContent = `${data.services.database.latency}ms`;

    // Update cache status
    const cacheStatus = document.getElementById('cacheStatus');
    if (data.services.cache.status === 'operational') {
        cacheStatus.textContent = 'Operational';
        cacheStatus.className = 'px-4 py-2 bg-green-100 text-green-600 rounded-full text-sm font-semibold';
    } else {
        cacheStatus.textContent = 'Error';
        cacheStatus.className = 'px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm font-semibold';
    }

    // Update metrics
    document.getElementById('memoryUsage').textContent = formatBytes(data.metrics.memory.usage);
    document.getElementById('memoryPeak').textContent = formatBytes(data.metrics.memory.peak);
    document.getElementById('serverUptime').textContent = formatUptime(data.metrics.uptime.server);
    document.getElementById('phpUptime').textContent = formatUptime(data.metrics.uptime.php);
    document.getElementById('totalRequests').textContent = data.metrics.requests.total.toLocaleString();
    document.getElementById('requestsPerMinute').textContent = data.metrics.requests.per_minute.toLocaleString();

    // Update version info
    document.getElementById('apiVersion').textContent = data.version.api;
    document.getElementById('laravelVersion').textContent = data.version.laravel;
}

async function fetchStatus() {
    try {
        const response = await fetch('/api/status');
        const data = await response.json();
        updateUI(data);
    } catch (error) {
        console.error('Error fetching status:', error);
        document.getElementById('overallStatus').textContent = 'Error fetching status';
        statusIndicator.className = 'w-12 h-12 rounded-full flex items-center justify-center status-pulse text-red-500';
    }
}

// Initial fetch
fetchStatus();

// Refresh every 30 seconds
setInterval(fetchStatus, 30000);
</script>
@endpush
@endsection
