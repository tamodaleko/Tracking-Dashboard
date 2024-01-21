<?php

namespace App\Http\Controllers;

use App\Models\Campaign\CampaignStat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->user()->company;

        $products = $company->orders()->where('created_at', '>=', Carbon::today())->sum('quantity');
        $total = $company->orders()->where('created_at', '>=', Carbon::today())->sum('total');

        $cost = $company->orders()->where('created_at', '>=', Carbon::today())->sum('cost');

        // foreach ($company->campaigns )
        
        return view('dashboard.index', [
            'company' => $company,
            'products' => $products,
            'total' => $total,
            'cost' => $cost
        ]);
    }
}
