<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // During development, we'll use static content
        // Later this can be moved to a database or CMS
        return view('about');
    }
}
