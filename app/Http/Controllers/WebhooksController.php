<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class WebhooksController extends Controller
{
    public function shopify(Company $company, Request $request): bool
    {
        if (!$this->verifyShopifySecret($company, $request)) {
            \Illuminate\Support\Facades\Log::emergency('Webhook not verified.');
            return false;
        }

        $topic = $request->header('X-Shopify-Topic');

        $data = json_decode($request->getContent(), true);

        \Illuminate\Support\Facades\Log::emergency('Order ID: ' . $data['id']);

        if ($topic === 'orders/create') {
            $this->createShopifyOrder($company, $data);
        }

        return true;
    }

    private function verifyShopifySecret(Company $company, Request $request): bool
    {
        $secret = $company->sf_webhook_secret;

        if (!$secret) {
            return false;
        }

        $signature = $request->header('X-Shopify-Hmac-Sha256');

        $calculateSignature = base64_encode(hash_hmac('sha256', $request->getContent(), $secret, true));

        return hash_equals($signature, $calculateSignature);
    }

    private function createShopifyOrder(Company $company, array $data): bool
    {
        $total = 0;
        $cost = 0;
        $quantity = 0;
        
        $items = [];

        foreach ($data['line_items'] as $item) {
            $product = Product::where('company_id', $company->id)
                ->where('code', $item['sku'])
                ->first();
            
            $items[] = [
                'shopify_id' => $item['id'],
                'quantity' => $item['quantity'],
                'product_id' => $product ? $product->id : null,
                'price' => $item['price']
            ];

            $total += $item['price'] * $item['quantity'];
            $quantity += $item['quantity'];

            $cost += $product ? $product->buying_price : 0;
        }

        $freeShipping = ($total > 2000) ? true : false;

        if ($freeShipping) {
            $cost += 280;
        }
        
        $order = Order::create([
            'company_id' => $company->id,
            'shopify_id' => $data['id'],
            'first_name' => ucwords(strtolower(trim($data['billing_address']['first_name']))),
            'last_name' => ucwords(strtolower(trim($data['billing_address']['last_name']))),
            'address' => ucwords(strtolower(trim($data['billing_address']['address1']))),
            'city' => ucwords(strtolower(trim($data['billing_address']['city']))),
            'zip' => strtolower(trim($data['billing_address']['zip'])),
            'phone' => strtolower(trim($data['billing_address']['phone'])),
            'total' => $total,
            'cost' => $cost + 102,
            'free_shipping' => $freeShipping,
            'quantity' => $quantity,
            'status' => 'created'
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'shopify_id' => $item['shopify_id'],
                'total' => $item['price'] * $item['quantity'],
                'quantity' => $item['quantity']
            ]);
        }

        return true;
    }
}
