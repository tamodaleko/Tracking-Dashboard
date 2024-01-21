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
            ->sum('quantity');
        
        $total = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->sum('total');
        
        $cost = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->sum('cost');

        $orders = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->count();
        
        $sendCost = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->count() * 102;
        
        $shippingCost = $company->orders()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('free_shipping', true)
            ->count() * 280;

        $data = [];

        foreach ($company->campaigns as $campaign) {
            $stats = $campaign->getStats($startDate, $endDate);

            $adSpend = 0;

            foreach ($stats as $stat) {
                $adSpend += $stat->spend_rsd;
            }

            $cost += $adSpend;

            $orderQuery = Order::where('company_id', $company->id)
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->where('product_id', $campaign->product_id)
                ->whereDate('orders.created_at', '>=', $startDate)
                ->whereDate('orders.created_at', '<=', $endDate);

            $orderItemQuery = OrderItem::where('company_id', $company->id)
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('product_id', $campaign->product_id)
                ->whereDate('orders.created_at', '>=', $startDate)
                ->whereDate('orders.created_at', '<=', $endDate);

            $data[$campaign->id]['products'] = $orderItemQuery->clone()->sum('order_items.quantity');
            $data[$campaign->id]['total'] = $orderQuery->clone()->sum('order_items.total');
            $data[$campaign->id]['productCost'] = $data[$campaign->id]['products'] * ($campaign->product ? $campaign->product->buying_price : 0);
            $data[$campaign->id]['adCost'] = $adSpend;

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
