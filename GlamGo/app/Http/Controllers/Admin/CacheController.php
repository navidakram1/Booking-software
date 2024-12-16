<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function index()
    {
        return view('admin.cache.index');
    }

    public function clear()
    {
        Cache::flush();
        Artisan::call('cache:clear');
        
        return redirect()->route('admin.cache')
            ->with('success', 'Application cache cleared successfully');
    }

    public function clearViews()
    {
        Artisan::call('view:clear');
        
        return redirect()->route('admin.cache')
            ->with('success', 'View cache cleared successfully');
    }

    public function clearRoutes()
    {
        Artisan::call('route:clear');
        
        return redirect()->route('admin.cache')
            ->with('success', 'Route cache cleared successfully');
    }

    public function clearConfig()
    {
        Artisan::call('config:clear');
        
        return redirect()->route('admin.cache')
            ->with('success', 'Configuration cache cleared successfully');
    }

    public function clearAll()
    {
        Cache::flush();
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        
        return redirect()->route('admin.cache')
            ->with('success', 'All caches cleared successfully');
    }
}
