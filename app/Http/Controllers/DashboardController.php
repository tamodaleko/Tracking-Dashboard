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
            'orders' => $company->orders()->count(),
            'spent' => $company->orders()->sum('total'),
            'licenses' => 0,
            'latestOrders' => $company->orders()->latest()->limit(5)->get()
        ]);
    }
}
