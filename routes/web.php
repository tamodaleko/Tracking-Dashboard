<?php

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
    exit;
    $campaigns = \App\Models\Campaign\Campaign::all();

    foreach ($campaigns as $campaign) {
        if ($campaign->product) {
            $campaign->product->update(['campaign_id' => $campaign->id]);
        } 
    }

    echo 'done';
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
    Route::patch('/products/{product}/campaign', [ProductsController::class, 'updateCampaign'])->name('products.update.campaign');

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
