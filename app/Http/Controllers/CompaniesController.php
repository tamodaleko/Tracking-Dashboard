<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\UpdateCompanyKeysRequest;
use App\Models\Campaign\Campaign;
use App\Models\Campaign\CampaignStat;
use App\Models\Product;
use App\Services\ExchangeRateService;
use App\Services\SPService;
use Exception;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use Illuminate\Http\RedirectResponse;

class CompaniesController extends Controller
{
    public function updateKeys(UpdateCompanyKeysRequest $request): RedirectResponse
    {
        switch ($request->provider) {
            case 'slanje_paketa':
                return $this->updateSlanjePaketa($request->sp_api_key);
                break;
            case 'facebook':
                return $this->updateFacebook($request->fb_app_id, $request->fb_app_secret, $request->fb_access_token, $request->fb_ad_account_id);
                break;
            case 'shopify':
                return $this->updateShopify($request->sf_webhook_secret);
                break;
        }

        return redirect()->route('dashboard.index')
                ->withError('Integracija nije sačuvana. Molimo pokušaj opet.');
    }

    private function updateSlanjePaketa(?string $sp_api_key): RedirectResponse
    {
        if (!$sp_api_key) {
            return redirect()->route('dashboard.index')
                ->withError('Integracija nije sačuvana. Molimo proveri informacije i pokušaj opet.');
        }
        
        try {
            $products = (new SPService(trim($sp_api_key)))->getProducts();
        } catch (Exception $e) {
            return redirect()->route('dashboard.index')
                ->withError('Slanje paketa nije moguće povezati. Proveri da li je API key ispravan.');
        }

        if (!isset($products['totalCount']) || !$products['totalCount'] || !isset($products['data'])) {
            return redirect()->route('dashboard.index')
                ->withError('Slanje paketa nije moguće povezati. Proizvodi nisu pronadjeni.');
        }
        
        auth()->user()->company->update(['sp_api_key' => trim($sp_api_key)]);

        foreach ($products['data'] as $product) {
            Product::create([
                'company_id' => auth()->user()->company->id,
                'sp_id' => $product['_id'],
                'code' => $product['code'],
                'name' => $product['name'],
                'url' => $product['url'],
                'image' => $product['image'],
                'selling_price' => $product['selling_price'],
                'qty_warehouse' => $product['temporary_quantity']['warehouse'],
                'qty_sending' => $product['temporary_quantity']['for_sending']
            ]);
        }

        return redirect()->route('dashboard.index')
                ->withSuccess('Slanje paketa je uspešno povezan!');
    }

    private function updateFacebook(
        ?string $fb_app_id, ?string $fb_app_secret, ?string $fb_access_token, ?string $fb_ad_account_id
    ): RedirectResponse
    {
        if (!$fb_app_id || !$fb_app_secret || !$fb_access_token || !$fb_ad_account_id) {
            return redirect()->route('dashboard.index')
                ->withError('Integracija nije sačuvana. Molimo proveri informacije i pokušaj opet.');
        }

        $api = Api::init($fb_app_id, $fb_app_secret, $fb_access_token);

        $api->setLogger(new CurlLogger);

        $fields = [
            'campaign_id',
            'reach',
            'impressions',
            'spend',
            'cpc',
            'clicks',
            'campaign_name',
            'account_currency',
            'conversions',
            'actions'
        ];
        
        $params = [
            'date_preset' => 'today',
            'level' => 'campaign'
        ];

        try {
            $acc = new AdAccount('act_' . $fb_ad_account_id);
            $campaigns = $acc->getInsights($fields, $params)->getResponse()->getContent();
        } catch (Exception $e) {
            return redirect()->route('dashboard.index')
                ->withError('Facebook nije moguće povezati. Proveri da li su informacije tačne.');
        }

        dd($campaigns);

        if (!isset($campaigns['data']) || !$campaigns['data']) {
            return redirect()->route('dashboard.index')
                ->withError('Facebook nije moguće povezati. Kampanje nisu pronadjene.');
        }

        auth()->user()->company->update([
            'fb_app_id' => trim($fb_app_id),
            'fb_app_secret' => trim($fb_app_secret),
            'fb_access_token' => trim($fb_access_token),
            'fb_ad_account_id' => trim($fb_ad_account_id)
        ]);

        foreach ($campaigns['data'] as $campaign) {
            $cc = Campaign::create([
                'company_id' => auth()->user()->company->id,
                'facebook_id' => $campaign['campaign_id'],
                'name' => $campaign['campaign_name'],
                'currency' => $campaign['account_currency']
            ]);

            foreach ($campaign['actions'] as $action) {
                if ($action['action_type'] === 'purchase') {
                    $conversions = $action['value'];
                }
            }

            CampaignStat::create([
                'campaign_id' => $cc->id,
                'reach' => $campaign['reach'] ?? 0,
                'impressions' => $campaign['impressions'] ?? 0,
                'spend' => $campaign['spend'] ?? 0,
                'spend_rsd' => (new ExchangeRateService)->convertToRSD($campaign['account_currency'], $campaign['spend'] ?? 0),
                'cpc' => $campaign['cpc'] ?? 0,
                'clicks' => $campaign['clicks'] ?? 0,
                'conversions' => $conversions ?? 0,
                'date' => $campaign['date_start']
            ]);
        }

        return redirect()->route('dashboard.index')
                ->withSuccess('Facebook je uspešno povezan!');
    }

    private function updateShopify(?string $sf_webhook_secret): RedirectResponse
    {
        if (!$sf_webhook_secret) {
            return redirect()->route('dashboard.index')
                ->withError('Integracija nije sačuvana. Molimo proveri informacije i pokušaj opet.');
        }

        auth()->user()->company->update([
            'sf_webhook_secret' => trim($sf_webhook_secret)
        ]);

        return redirect()->route('dashboard.index')
                ->withSuccess('Shopify je uspešno povezan!');
    }
}
