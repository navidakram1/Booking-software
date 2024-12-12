<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function retention()
    {
        return view('admin.analytics.retention');
    }

    public function revenue()
    {
        return view('admin.analytics.revenue');
    }

    public function trends()
    {
        return view('admin.analytics.trends');
    }

    public function abandoned()
    {
        return view('admin.analytics.abandoned');
    }
}
