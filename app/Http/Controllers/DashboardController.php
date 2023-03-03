<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View|Application
    {
        return view('dashboard.index');
    }

}
