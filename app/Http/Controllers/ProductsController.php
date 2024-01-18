<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UpdateProductPriceRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        
        return view('products.index', compact('products'));
    }

    public function updatePrice(Product $product, UpdateProductPriceRequest $request): RedirectResponse
    {
        $product->update(['buying_price' => $request->buying_price]);

        return redirect()->route('products.index')
                ->withSuccess('Kupovna cena proizvoda je uspešno sačuvana.');
    }
}
