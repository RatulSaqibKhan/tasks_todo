<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * View Dashboard
     * 
     * @return View
     */
    public function index(): View
    {
        return view('dashboards.management');
    }
}
