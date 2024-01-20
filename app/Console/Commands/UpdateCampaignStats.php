<?php

namespace App\Console\Commands;

use App\Models\Campaign\Campaign;
use App\Models\Campaign\CampaignStats;
use App\Models\Company;
use App\Services\ExchangeRateService;
use Exception;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use Illuminate\Console\Command;

class UpdateCampaignStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-campaign-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update campaign stats';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $companies = Company::all();

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

        foreach ($companies as $company) {
            if (!$company->isSetUp('facebook')) {
                continue;
            }

            $api = Api::init($company->fb_app_id, $company->fb_app_secret, $company->fb_access_token);

            $api->setLogger(new CurlLogger);

            $acc = new AdAccount('act_' . $company->fb_ad_account_id);
            $campaigns = $acc->getInsights($fields, $params)->getResponse()->getContent();

            foreach ($campaigns['data'] as $campaign) {
                $cc = Campaign::where('company_id', $company->id)
                    ->where('facebook_id', $campaign['campaign_id'])
                    ->first();

                if (!$cc) {
                    $cc = Campaign::create([
                        'company_id' => $company->id,
                        'facebook_id' => $campaign['campaign_id'],
                        'name' => $campaign['campaign_name'],
                        'currency' => $campaign['account_currency']
                    ]);
                }

                foreach ($campaign['actions'] as $action) {
                    if ($action['action_type'] === 'purchase') {
                        $conversions = $action['value'];
                    }
                }

                $stats = CampaignStat::where('campaign_id', $cc->id)
                    ->where('date', $campaign['date_start'])
                    ->first();

                $reach = $campaign['reach'] ?? 0;
                $impressions = $campaign['impressions'] ?? 0;
                $spend = $campaign['spend'] ?? 0;
                $spend_rsd = (new ExchangeRateService)->convertToRSD($campaign['account_currency'], $campaign['spend'] ?? 0);
                $cpc = $campaign['cpc'] ?? 0;
                $clicks = $campaign['clicks'] ?? 0;
                $conversions = $conversions ?? 0;

                if ($stats) {
                    $stats->update([
                        'reach' => $reach,
                        'impressions' => $impressions,
                        'spend' => $spend,
                        'spend_rsd' => $spend_rsd,
                        'cpc' => $cpc,
                        'clicks' => $clicks,
                        'conversions' => $conversions
                    ]);
                } else {
                    CampaignStat::create([
                        'campaign_id' => $cc->id,
                        'reach' => $reach,
                        'impressions' => $impressions,
                        'spend' => $spend,
                        'spend_rsd' => $spend_rsd,
                        'cpc' => $cpc,
                        'clicks' => $clicks,
                        'conversions' => $conversions,
                        'date' => $campaign['date_start']
                    ]);
                }
            }

            return true;
        }
    }
}
