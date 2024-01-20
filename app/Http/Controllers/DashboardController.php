<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->user()->company;
        
        return view('dashboard.index', [
            'company' => $company,
            'orders' => 0,
            'spent' => 0,
            'licenses' => 0,
            'latestOrders' => []
        ]);
    }
}
