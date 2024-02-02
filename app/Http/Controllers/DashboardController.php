<?php

namespace App\Http\Controllers;

use App\Models\Campaign\CampaignStat;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->user()->company;

        $startDate = $request->start_date ?: Carbon::now()->format('Y-m-d');
        $endDate = $request->end_date ?: Carbon::now()->format('Y-m-d');

        $products = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('status', 'created')
            ->sum('quantity');
        
        $total = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('status', 'created')
            ->sum('total');
        
        $cost = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('status', 'created')
            ->sum('cost');

        $orders = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('status', 'created')
            ->count();
        
        $sendCost = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('status', 'created')
            ->count() * 102;
        
        $shippingCost = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('free_shipping', true)
            ->where('status', 'created')
            ->count() * 280;

        $data = [];

        foreach ($company->campaigns as $campaign) {
            $stats = $campaign->getStats($startDate, $endDate);

            $adSpend = 0;

            foreach ($stats as $stat) {
                $adSpend += $stat->spend_rsd;
            }

            $cost += $adSpend;

            $productIds = $campaign->products()->pluck('id')->toArray();

            $orderQuery = Order::where('company_id', $company->id)
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->whereIn('product_id', $productIds)
                ->whereDate('orders.created_at', '>=', $startDate)
                ->whereDate('orders.created_at', '<=', $endDate)
                ->where('status', 'created');

            $orderItemQuery = OrderItem::where('company_id', $company->id)
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->whereIn('product_id', $productIds)
                ->whereDate('orders.created_at', '>=', $startDate)
                ->whereDate('orders.created_at', '<=', $endDate)
                ->where('status', 'created');

            $productQuantity = $orderItemQuery->clone()
                ->groupBy('product_id')
                ->selectRaw('sum(order_items.quantity) as quantity, product_id')
                ->pluck('quantity','product_id')
                ->toArray();

            $data[$campaign->id]['products'] = array_sum($productQuantity);
            $data[$campaign->id]['total'] = $orderQuery->clone()->sum('order_items.total');
            $data[$campaign->id]['adCost'] = $adSpend;
            $data[$campaign->id]['productCost'] = 0;

            foreach ($campaign->products as $product) {
                $data[$campaign->id]['productCost'] += (isset($productQuantity[$product->id])) ? ($productQuantity[$product->id] * $product->buying_price) : 0;
            }

            $data[$campaign->id]['totalCost'] = $data[$campaign->id]['productCost'] + $data[$campaign->id]['adCost'];
        }
        
        return view('dashboard.index', [
            'company' => $company,
            'products' => $products,
            'total' => $total,
            'cost' => $cost,
            'orders' => $orders,
            'sendCost' => $sendCost,
            'shippingCost' => $shippingCost,
            'data' => $data
        ]);
    }
}
