<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaptopsController;
use App\Http\Controllers\LicensesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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
    dd((new \App\Services\SPService)->getProducts());
    $api = \FacebookAds\Api::init('1409959359610602', '7709b913e276c61a737f7fe081890061', 'EAAUCWb7GZCuoBOZCyp9Ds3MaBTpgUVSzzvKfhZBM8wUlu9nmR35GdOkkfJU8zYcTDEHUWZA505dMglryQRxEHcCo1DhxBJt6eLcVRHQ7DsZAKz8GuQtZBUDtYzRr2P5QH8FYlB4K33d7lfmKZBCchqnIHohZBsX9ikdOOVbr1HIgbZAjhhjRX1S0fdwnejvqDxA8ZCRdxnQj38');

    // The Api object is now available through singleton
    $api->setLogger(new \FacebookAds\Logger\CurlLogger());

    $fields = [
      'reach',
      'impressions',
      'results',
      'delivery',
      'spend',
      'actions:omni_purchase',
      'actions:app_custom_event.fb_mobile_purchase',
      'actions:offsite_conversion.fb_pixel_purchase',
      'actions:offline_conversion.purchase',
      'actions:onsite_conversion.purchase',
      'unique_actions:omni_purchase',
      'unique_actions:app_custom_event.fb_mobile_purchase',
      'action_values:omni_purchase',
      'action_values:app_custom_event.fb_mobile_purchase',
      'action_values:offsite_conversion.fb_pixel_purchase',
      'action_values:offline_conversion.purchase',
      'action_values:onsite_conversion.purchase',
      'cost_per_unique_action_type:omni_purchase',
      'cost_per_action_type:omni_purchase',
      'campaign_group_id',
      'campaign_group_name',
      'account_id',
      'account_name'
    ];
    
    $params = [
      'time_range' => ['since' => '2023-12-19','until' => '2024-01-18'],
      'filtering' => [],
      'level' => 'campaign',
      'breakdowns' => []
    ];

    $acc = new \FacebookAds\Object\AdAccount('act_406249175264796');

    $campaign = new \FacebookAds\Object\Campaign('120330000218110110');

    dd($campaign->getInsights()->getResponse()->getContent());

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

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Products
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');

    // Licenses
    Route::get('/licenses', [LicensesController::class, 'index'])->name('licenses.index');
    Route::get('/licenses/{license}/order', [LicensesController::class, 'order'])->name('licenses.order');
    Route::post('/licenses/{license}/order', [LicensesController::class, 'process'])->name('licenses.process');

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
