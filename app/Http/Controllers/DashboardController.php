<?php

namespace App\Http\Controllers;

use App\Models\Campaign\CampaignStat;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        dd(\App\Models\Product::all());
        $company = $request->user()->company;

        $products = $company->orders()->where('created_at', '>=', Carbon::today())->sum('quantity');
        $total = $company->orders()->where('created_at', '>=', Carbon::today())->sum('total');
        $cost = $company->orders()->where('created_at', '>=', Carbon::today())->sum('cost');

        $data = [];

        foreach ($company->campaigns as $campaign) {
            $stats = $campaign->getStats();

            if ($stats) {
                $cost += $stats->spend_rsd;
            }

            $orderQuery = Order::where('company_id', $company->id)
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->where('order_items.product_id', $campaign->product_id)
                ->where('orders.created_at', '>=', Carbon::today());

            $data[$campaign->id]['products'] = $orderQuery->clone()->sum('orders.quantity');
            $data[$campaign->id]['total'] = $orderQuery->clone()->sum('orders.total');
            $data[$campaign->id]['productCost'] = $data[$campaign->id]['products'] * $campaign->product->buying_price;
            $data[$campaign->id]['adCost'] = $stats->spend_rsd;
            $data[$campaign->id]['sendCost'] = $orderQuery->clone()->count('orders.id') * 102;
            $data[$campaign->id]['shippingCost'] = $orderQuery->clone()->where('orders.total', '>', 2000)->count('orders.id') * 280;

            $data[$campaign->id]['totalCost'] = $data[$campaign->id]['productCost'] + $data[$campaign->id]['adCost'] + $data[$campaign->id]['sendCost'] + $data[$campaign->id]['shippingCost'];
        }
        
        return view('dashboard.index', [
            'company' => $company,
            'products' => $products,
            'total' => $total,
            'cost' => $cost,
            'data' => $data
        ]);
    }
}
