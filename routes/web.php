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
    $product = \App\Models\Product::find(5);

    $orders = \App\Models\Order\Order::where('created_at', '>=', '2024-01-27 00:00:00')->get();

    foreach ($orders as $order) {
        dd($order->items);
        $cost = 0;
        $total = 0;
        
        foreach ($order->items as $item) {
            $product = $item->product;

            $item->update(['total' => $item->quantity * $product->price]);

            $cost += $product->buying_price * $item->quantity;
            $total += $product->price * $item->quantity;
        }

        $freeShipping = ($total > 2000) ? true : false;

        if ($freeShipping) {
            $cost += 280;
        }

        $order->update(['cost' => $cost + 102]);
    }

    dd($orders);
    // $campaignStats = \App\Models\Campaign\CampaignStat::where
    // $order = \App\Models\Order\Order::create([
    //   'company_id' => 1,
    //   'shopify_id' => 5697825734933,
    //   'first_name' => 'Dragana',
    //   'last_name' => 'Punos',
    //   'address' => 'Andjelka Čobanovica 33',
    //   'city' => 'Dobanovci',
    //   'zip' => '11272',
    //   'phone' => '+38169702484',
    //   'total' => 990,
    //   'cost' => 366,
    //   'quantity' => 1,
    //   'free_shipping' => false,
    //   'status' => 'created'
    // ]);

    // \App\Models\Order\OrderItem::create([
    //   'order_id' => $order->id,
    //   'product_id' => 1,
    //   'shopify_id' => 6817582792981,
    //   'total' => 990,
    //   'quantity' => 1
    // ]);

    // $companies = \App\Models\Company::all();

    // $fields = [
    //   'campaign_id',
    //   'reach',
    //   'impressions',
    //   'spend',
    //   'cpc',
    //   'clicks',
    //   'campaign_name',
    //   'account_currency',
    //   'conversions',
    //   'actions'
    // ];
    
    // $params = [
    //   'date_preset' => 'yesterday',
    //   'level' => 'campaign'
    // ];

    // foreach ($companies as $company) {
    //   $api = \FacebookAds\Api::init($company->fb_app_id, $company->fb_app_secret, $company->fb_access_token);

    //   $api->setLogger(new \FacebookAds\Logger\CurlLogger);

    //   $acc = new \FacebookAds\Object\AdAccount('act_' . $company->fb_ad_account_id);
    //   $campaigns = $acc->getInsights($fields, $params)->getResponse()->getContent();

    //   dd($campaigns);
    // }
    
    dd(\App\Models\Company::first());
    
    $api = \FacebookAds\Api::init('1409959359610602', '7709b913e276c61a737f7fe081890061', 'EAAUCWb7GZCuoBOZC5otBpMce7zvE5TUKFjHy7dKQn3D8xzpCjuSTa2CXMaLDvFyFlODV5SaZBKTE4di0duXLFdPgZAFQX05Q9x6EGzE698pWICFrZA4k9OtxNrGQ7CGO1KzwK6fanUoHm1QlBlcZAViWduTXWOQhhpri2ZBwwbopWUZBnoqpuNSSIOuCaGPe4PGP');
});

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// Webhooks
Route::post('/webhooks/{company}/shopify', [WebhooksController::class, 'shopify'])->name('webhooks.shopify');
Route::put('/webhooks/{company}/slanje-paketa', [WebhooksController::class, 'slanjePaketa'])->name('webhooks.slanjePaketa');

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
