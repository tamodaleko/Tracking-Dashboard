<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://kurs.resenje.org/api/v1/currencies';
    }

    public function convertToRSD(string $currency, float $amount): float
    {
        $url = $this->baseUrl . '/' . $currency . '/conversions/' . $amount . '/today';
        
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->get($url);

        return number_format((float) $response['buy_exchange'] ?? 0, 2, '.', '');
    }
}
