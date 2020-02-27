<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        return view('dashboard.dashboard');
    }

    public function parent()
    {
        return view('dashboard.parent');
    }

    public function childA()
    {
        return view('dashboard.child-a');
    }

    public function childB()
    {
        return view('dashboard.child-b');
    }
}
