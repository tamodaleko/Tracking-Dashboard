<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaptopsController;
use App\Http\Controllers\LicensesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmsMessagesController;
use App\Http\Controllers\SmsTemplatesController;
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

Route::get('/test', function (Request $request) {
    $products = \App\Models\Product::all();

    foreach ($products as $product) {
        echo $product->name . ': ' . \App\Models\Order\OrderItem::where('created_at', '>=', '2024-03-01 00:00:00')->where('product_id', $product->id)->count();
        echo '<br/>';
    }

    exit;
    $startDate = $request->start_date ?: \Carbon\Carbon::now()->format('Y-m-d');
    $endDate = $request->end_date ?: \Carbon\Carbon::now()->format('Y-m-d');

    $company = \App\Models\Company::first();

    $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

    $dates = [];

    foreach ($period as $date) {
        $products = $company->orders()
            ->whereDate('created_at', '>=', $date)
            ->whereDate('created_at', '<=', $date)
            ->where('status', 'created')
            ->sum('quantity');
    
        $total = $company->orders()
            ->whereDate('created_at', '>=', $date)
            ->whereDate('created_at', '<=', $date)
            ->where('status', 'created')
            ->sum('total');
        
        $cost = $company->orders()
            ->whereDate('created_at', '>=', $date)
            ->whereDate('created_at', '<=', $date)
            ->where('status', 'created')
            ->sum('cost');

        foreach ($company->campaigns as $campaign) {
            $stats = $campaign->getStats($date, $date);

            $adSpend = 0;

            foreach ($stats as $stat) {
                $adSpend += $stat->spend_rsd;
            }

            $cost += $adSpend;
        }

        $dates[$date->format('Y-m-d')] = [
            'products' => $products,
            'total' => $total,
            'profit' => $total - $cost
        ];
    }

    foreach ($dates as $d => $row) {
        echo 'Date:' . $d;
        echo '<br/>';
        echo 'Products: ' . $row['products'];
        echo '<br/>';
        echo 'Total: ' . number_format($row['total'], 2, '.', ',');
        echo '<br/>';
        echo 'Profit: ' . number_format($row['profit'], 2, '.', ',');
        echo '<br/>';
        echo '<br/>';
    }
});

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/google-connect', function () {
    $oauth2 = new \Google\Auth\OAuth2(
        [
            'clientId' => config('services.googleAds.client_id'),
            'clientSecret' => config('services.googleAds.client_secret'),
            'authorizationUri' => 'https://accounts.google.com/o/oauth2/v2/auth',
            'redirectUri' => 'https://dashboard.shoppex.rs/google-oauth',
            'tokenCredentialUri' => \Google\Auth\CredentialsLoader::TOKEN_CREDENTIAL_URI,
            'scope' => 'https://www.googleapis.com/auth/adwords',
            'state' => sha1(openssl_random_pseudo_bytes(1024))
        ]
    );

    echo '<a href="' . $oauth2->buildFullAuthorizationUri() . '">Connect Google Ads</a>';
});

Route::get('/google-oauth', function (Request $request) {
    $oauth2 = new \Google\Auth\OAuth2(
        [
            'clientId' => config('services.googleAds.client_id'),
            'clientSecret' => config('services.googleAds.client_secret'),
            'authorizationUri' => 'https://accounts.google.com/o/oauth2/v2/auth',
            'redirectUri' => 'https://dashboard.shoppex.rs/google-oauth',
            'tokenCredentialUri' => \Google\Auth\CredentialsLoader::TOKEN_CREDENTIAL_URI,
            'scope' => 'https://www.googleapis.com/auth/adwords',
            'state' => sha1(openssl_random_pseudo_bytes(1024))
        ]
    );

    $oauth2->setCode($request->code);
    $authToken = $oauth2->fetchAuthToken();
    // $refreshToken = $authToken['refresh_token'];

    dd($authToken);
});

Route::get('/google-test', function (Request $request) {
    $oAuth2Credential = (new \Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder())
        ->withClientId(config('services.googleAds.client_id'))
        ->withClientSecret(config('services.googleAds.client_secret'))
        ->withRefreshToken('1//09lral1sJyt75CgYIARAAGAkSNwF-L9Iru6P2XA5fZeBdp75CBEi13u4NFlKb4bYk0HDGHzg6YwjhAwf-yKS4qrwC4GxWoM--ORQ')
        ->build();

    $googleAdsClient = (new \Google\Ads\GoogleAds\Lib\V16\GoogleAdsClientBuilder())
        ->withOAuth2Credential($oAuth2Credential)
        ->withDeveloperToken(config('services.googleAds.developer_token'))
        ->withLoginCustomerId('7737781256')
        // ->withLinkedCustomerId(config('services.googleAds.customer_id'))
        ->build();

    $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();
    
    // Creates a query that retrieves all campaigns.
    $query = 'SELECT campaign.id, campaign.name FROM campaign ORDER BY campaign.id';
    // Issues a search stream request.
    
    /** @var GoogleAdsServerStreamDecorator $stream */
    $stream = $googleAdsServiceClient->searchStream(
        \Google\Ads\GoogleAds\V16\Services\SearchGoogleAdsStreamRequest::build(config('services.googleAds.customer_id'), $query)
    );

    foreach ($stream->iterateAllElements() as $googleAdsRow) {
        /** @var GoogleAdsRow $googleAdsRow */
        printf(
            "Campaign with ID %d and name '%s' was found.%s",
            $googleAdsRow->getCampaign()->getId(),
            $googleAdsRow->getCampaign()->getName(),
            PHP_EOL
        );
    }

    // dd($googleAdsClient);
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

    // SMS Templates
    Route::get('/sms-templates', [SmsTemplatesController::class, 'index'])->name('smsTemplates.index');
    Route::patch('/sms-templates/{template}/text', [SmsTemplatesController::class, 'updateText'])->name('templates.update.text');

    // SMS Messages
    Route::get('/sms-messages', [SmsMessagesController::class, 'index'])->name('smsMessages.index');
});

require __DIR__.'/auth.php';
