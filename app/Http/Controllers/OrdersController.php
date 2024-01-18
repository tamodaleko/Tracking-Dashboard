<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function index(Request $request): View
    {
        $orders = $request->user()->company->orders()->latest()->get();

        return view('orders.index', compact('orders'));
    }
}
