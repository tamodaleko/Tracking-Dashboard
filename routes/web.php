<?php

use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaptopsController;
use App\Http\Controllers\LicensesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WebhooksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\CampaignFields;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
  dd(\App\Models\Order\Order::all());
    dd((new \App\Services\ExchangeRateService)->convertToRSD('EUR', 50));
    // dd((new \App\Services\SPService)->getProducts());
    $api = \FacebookAds\Api::init('1409959359610602', '7709b913e276c61a737f7fe081890061', 'EAAUCWb7GZCuoBOZC5otBpMce7zvE5TUKFjHy7dKQn3D8xzpCjuSTa2CXMaLDvFyFlODV5SaZBKTE4di0duXLFdPgZAFQX05Q9x6EGzE698pWICFrZA4k9OtxNrGQ7CGO1KzwK6fanUoHm1QlBlcZAViWduTXWOQhhpri2ZBwwbopWUZBnoqpuNSSIOuCaGPe4PGP');

    // The Api object is now available through singleton
    $api->setLogger(new \FacebookAds\Logger\CurlLogger());

    $fields = [
      'reach',
      'impressions',
      'objective',
      'spend',
      'cpc',
      'clicks',
      'campaign_name',
      'account_currency',
      'conversions',
      'actions',
      'converted_product_quantity',
      'cost_per_conversion',
      'campaign_id'
    ];
    
    $params = [
      'date_preset' => 'today',
      'level' => 'campaign',
      'use_unified_attribution_setting' => true,
      'fields' => ['conversions']
    ];

    $acc = new \FacebookAds\Object\AdAccount('act_622598460014195');

    $campaigns = $acc->getCampaigns()->getResponse()->getContent();

    foreach ($campaigns['data'] as $campaign) {
      $cc = new \FacebookAds\Object\Campaign($campaign['id']);

      dd($acc->getInsights($fields, $params)->getResponse()->getContent());

      $adSets = $cc->getAdSets()->getResponse()->getContent();

      foreach ($adSets['data'] as $adSet) {
        $as = new \FacebookAds\Object\AdSet($adSet['id']);
        
        dd($as->getInsights($fields)->getResponse()->getContent());
      }
    }

    dd($acc->getInsights()->getResponse()->getContent());

    // $campaign = $acc->createCampaign(
    //     [],
    //     [
    //       'objective' => 'OUTCOME_TRAFFIC',
    //       'name' => 'My Test Campaign',
    //       'status' => 'PAUSED',
    //       'special_ad_categories' => []
    //     ]
    // );

    // dd($campaign->id);

    // 120330000218110110

    $adset = $acc->createAdSet(
        [],
        [
          AdSetFields::NAME => 'My Test AdSet 1',
          AdSetFields::CAMPAIGN_ID => 120330000218109810,
          AdSetFields::DAILY_BUDGET => 150,
          AdSetFields::START_TIME => (new \DateTime("+1 week"))->format(\DateTime::ISO8601),
          AdSetFields::END_TIME => (new \DateTime("+2 week"))->format(\DateTime::ISO8601),
          AdSetFields::BILLING_EVENT => 'IMPRESSIONS',
          AdSetFields::TARGETING => array('geo_locations' => array('countries' => array('US'))),
          AdSetFields::BID_AMOUNT => '1000',
        ]
    );

    // echo $adset->id;

    $image = $acc->createAdImage(
      array(),
      array(
        'filename' => asset('/laptop.jpg'),
      )
    );
    echo 'Image Hash: '.$image->hash . "\n";

    $creative = $acc->createAdCreative(
      array(),
      array(
        \FacebookAds\Object\Fields\AdCreativeFields::NAME => 'Sample Creative',
        \FacebookAds\Object\Fields\AdCreativeFields::TITLE => 'Welcome to the Jungle',
        \FacebookAds\Object\Fields\AdCreativeFields::BODY => 'We\'ve got fun \'n\' games',
        \FacebookAds\Object\Fields\AdCreativeFields::IMAGE_HASH => $image->hash,
        \FacebookAds\Object\Fields\AdCreativeFields::OBJECT_URL => 'http://www.example.com/',
      )
    );

    $acc->createAd(
      array(),
      array(
        \FacebookAds\Object\Fields\AdFields::CREATIVE => array('creative_id' => $creative->id),
        \FacebookAds\Object\Fields\AdFields::NAME => 'My First Ad',
        \FacebookAds\Object\Fields\AdFields::ADSET_ID => $adset->id,
      )
    );

    echo 'Ad ID:' . $ad->id . "\n";

    exit;

    dd($acc->getInsights()->getResponse([], $params)->getContent());
    echo json_encode($acc->getInsights($fields, $params)->getResponse()->getContent(), JSON_PRETTY_PRINT);
});

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// Webhooks
Route::post('/webhooks/{company}/shopify', [WebhooksController::class, 'shopify'])->name('webhooks.shopify');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Companies
    Route::patch('/companies/keys', [CompaniesController::class, 'updateKeys'])->name('companies.update.keys');
    
    // Products
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::patch('/products/{product}/price', [ProductsController::class, 'updatePrice'])->name('products.update.price');

    // Campaigns
    Route::patch('/campaigns/{campaign}/product', [CampaignsController::class, 'updateProduct'])->name('campaigns.update.product');

    // Users
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    // Payments
    Route::post('/payments/setup', [PaymentsController::class, 'setup'])->name('payments.setup');
    Route::post('/payments/credit-card', [PaymentsController::class, 'creditCard'])->name('payments.creditCard');

    // Billing
    Route::get('/billing', function (Request $request) {
        return $request->user()->company->redirectToBillingPortal(route('dashboard.index'));
    })->name('billing');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Orders
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';
