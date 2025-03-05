<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->take(6)->get();
        $specialists = Specialist::with('services')->take(4)->get();
        return view('modern-home', compact('services', 'specialists'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Here you would typically send an email
        // For now, we'll just redirect with a success message
        return redirect()->route('contact.index')->with('success', 'Thank you for your message. We will get back to you soon!');
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
