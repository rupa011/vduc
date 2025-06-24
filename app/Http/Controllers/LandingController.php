<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.home');
    }

    // public function about()
    // {
    //     return view('landing.about');
    // }

    // public function services()
    // {
    //     return view('landing.services');
    // }

    // public function contact()
    // {
    //     return view('landing.contact');
    // }
}
