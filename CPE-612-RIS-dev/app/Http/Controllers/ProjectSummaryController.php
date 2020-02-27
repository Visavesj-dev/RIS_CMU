<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectSummaryController extends Controller
{
    public function individual()
    {
        return view("project-summary.individual");
    }

    public function department()
    {
        return view("project-summary.department");
    }

    public function tracking()
    {
        return view("project-summary.tracking");
    }
}
