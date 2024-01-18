<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LicensesController extends Controller
{
    public function index(): View
    {
        $licenses = License::all();
        
        return view('licenses.index', compact('licenses'));
    }

    public function order(Request $request, License $license): View
    {
        $paymentMethods = $request->user()->company->paymentMethods();
        
        return view('licenses.order', compact('license', 'paymentMethods'));
    }
}
