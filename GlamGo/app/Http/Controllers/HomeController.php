<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Booking;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::take(6)->get();
        $staff = Staff::with('services')->take(4)->get();
        return view('modern-home', compact('services', 'staff'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }

    public function cookies()
    {
        return view('cookies');
    }
}
