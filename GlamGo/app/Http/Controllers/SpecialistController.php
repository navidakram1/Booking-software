<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Service;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Staff::with('services')->get();
        $services = Service::all();
        return view('specialists', compact('specialists', 'services'));
    }

    public function show(Staff $specialist)
    {
        $specialist->load('services');
        return view('specialists.show', compact('specialist'));
    }
}
