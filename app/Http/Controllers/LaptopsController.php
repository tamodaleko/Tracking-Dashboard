<?php

namespace App\Http\Controllers;

use App\Http\Requests\Laptop\OrderLaptopRequest;
use App\Models\Laptop\Laptop;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Services\IngramService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaptopsController extends Controller
{
    public function index(): View
    {
        $laptops = Laptop::all();
        
        return view('laptops.index', compact('laptops'));
    }

    public function configure(Request $request, Laptop $laptop): View
    {
        $paymentMethods = $request->user()->company->paymentMethods();
        
        return view('laptops.configure', compact('laptop', 'paymentMethods'));
    }

    public function order(OrderLaptopRequest $request, Laptop $laptop): RedirectResponse
    {
        $variant = $laptop->variants()
            ->where('screen', $request->screen)
            ->where('color', $request->color)
            ->where('available', true)
            ->first();

        if (!$variant) {
            return redirect()->back()
                ->withError('Laptop variant not found. Please try again.');
        }

        if (!$variant->stock) {
            return redirect()->back()
                ->withError('Laptop variant out of stock. Please try again.');
        }

        if ($request->warranty) {
            if ($request->warranty_protection) {
                switch ($request->warranty_years) {
                    case 2:
                        $warranty = $laptop->warranties()->find(4);
                        break;
                    case 3:
                        $warranty = $laptop->warranties()->find(5);
                        break;
                    case 4:
                        $warranty = $laptop->warranties()->find(6);
                        break;
                }
            } else {
                switch ($request->warranty_years) {
                    case 2:
                        $warranty = $laptop->warranties()->find(1);
                        break;
                    case 3:
                        $warranty = $laptop->warranties()->find(2);
                        break;
                    case 4:
                        $warranty = $laptop->warranties()->find(3);
                        break;
                }
            }
        }

        $total = $variant->price + (isset($warranty) ? $warranty->price : 0);

        try {
            $charge = $request->user()->company->charge($total * 100, $request->payment_method);
        } catch (\Laravel\Cashier\Exceptions\IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('dashboard.index')]
            );
        } catch (Exception $e) {
            return redirect()->back()
                ->withError('We couldn\'t charge your payment method.');
        }

        $order = Order::create([
            'company_id' => $request->user()->company_id,
            'payment_method_id' => $request->payment_method,
            'total' => $total,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'status' => $charge ? 'completed' : 'pending'
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'variant_id' => $variant->id,
            'warranty_id' => isset($warranty) ? $warranty->id : null,
            'total' => $total
        ]);

        $ingramOrder = (new IngramService)->createOrder($order);

        $orderId = isset($ingramOrder['orders'][0]['ingramOrderNumber']) ? $ingramOrder['orders'][0]['ingramOrderNumber'] : null;

        if ($orderId) {
            $order->update([
                'ingram_id' => $orderId
            ]);
        }

        return redirect()->route('dashboard.index')
            ->withSuccess('Your order has been confirmed successfully!');
    }
}
