<?php

namespace App\Services;

use App\Models\Order\Order;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class SPService
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://softver.slanjepaketa.rs/api/v1';
        $this->apiKey = config('services.sp.api_key');
    }

    public function getProducts(): array
    {
        $url = $this->baseUrl . '/products';
        
        $response = $this->authenticatedRequest()->get($url);

        return $response->json();
    }

    public function getProductPriceAndAvailability(string $sku): array
    {
        $url = $this->baseUrl . '/catalog/priceandavailability?includeAvailability=true&includePricing=true';
        
        $response = $this->authenticatedRequest()->post($url, [
            'products' => [
                'ingramPartNumber' => $sku
            ]
        ]);

        return $response->json();
    }

    public function createOrder(Order $order): array
    {
        $url = $this->baseUrl . '/orders';

        $lines = [];

        foreach ($order->items as $k => $item) {
            if ($item->variant) {
                $lines[] = [
                    'customerLineNumber' => $k + 1,
                    'ingramPartNumber' => $item->variant->sku,
                    'quantity' => 1
                ];
            }

            if ($item->warranty) {
                $lines[] = [
                    'customerLineNumber' => $k + 1,
                    'ingramPartNumber' => $item->warranty->sku,
                    'quantity' => 1
                ];
            }
        }

        $data = [
            'customerOrderNumber' => 'order-' . $order->company_id . '-' . $order->id,
            'lines' => $lines,
            'shipToInfo' => [
                'contact' => $order->company->getAdmin()->name,
                'companyName' => $order->company->name,
                'name1' => $order->company->getAdmin()->name,
                'addressLine1' => $order->address1,
                'addressLine2' => $order->address2 ?: '',
                'city' => $order->city,
                'state' => $order->state,
                'postalCode' => $order->zip,
                'countryCode' => $order->country,
                'email' => $order->company->getAdmin()->email
            ]
        ];
        
        return $this->authenticatedRequest()->post($url, $data)->json();
    }

    private function authenticatedRequest(): PendingRequest
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Private ' . $this->apiKey
        ]);
    }
}
