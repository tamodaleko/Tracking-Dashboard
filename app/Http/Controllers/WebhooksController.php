<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class WebhooksController extends Controller
{
    public function shopify(Company $company, Request $request): bool
    {
        if (!$this->verifyShopifySecret($company, $request)) {
            \Illuminate\Support\Facades\Log::emergency('mrs');
            return false;
        }

        $topic = $request->header('X-Shopify-Topic');

        $data = json_decode($request->getContent(), true);

        \Illuminate\Support\Facades\Log::emergency($data);
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
}
