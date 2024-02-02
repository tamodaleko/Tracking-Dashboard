<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UpdateProductCampaignRequest;
use App\Http\Requests\Product\UpdateProductPriceRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(Request $request): View
    {
        $productQuery = Product::query();

        if ($request->search) {
            $productQuery->where('name', 'like', "%{$request->search}%");
        }

        $products = $productQuery->get();
        
        return view('products.index', compact('products'));
    }

    public function updatePrice(Product $product, UpdateProductPriceRequest $request): RedirectResponse
    {
        $product->update(['buying_price' => $request->buying_price]);

        return redirect()->route('products.index')
                ->withSuccess('Kupovna cena proizvoda je uspešno sačuvana.');
    }

    public function updateCampaign(Product $product, UpdateProductCampaignRequest $request): RedirectResponse
    {
        $product->update(['campaign_id' => $request->campaign_id]);

        return redirect()->route('products.index')
                ->withSuccess('Kampanja je uspešno povezana sa proizvodom.');
    }
}
