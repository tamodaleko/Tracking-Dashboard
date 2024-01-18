<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        
        return view('products.index', compact('products'));
    }
}