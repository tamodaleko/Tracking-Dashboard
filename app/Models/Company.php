<?php

namespace App\Models;

use App\Models\Campaign\Campaign;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sp_api_key',
        'fb_app_id',
        'fb_app_secret',
        'fb_access_token',
        'fb_ad_account_id',
        'sf_webhook_secret'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getAdmin(): User
    {
        return $this->users()->where('admin', true)->first();
    }

    public function isSetUp(?string $integration = null): bool
    {
        switch ($integration) {
            case 'slanje_paketa':
                return (bool) $this->sp_api_key;
            case 'facebook':
                return (bool) $this->fb_app_id && $this->fb_app_secret && $this->fb_access_token && $this->fb_ad_account_id;
            case 'shopify':
                return (bool) $this->sf_webhook_secret;
            default:
                return $this->sp_api_key && $this->fb_app_id && $this->fb_app_secret && $this->fb_access_token && $this->fb_ad_account_id && $this->sf_webhook_secret;
        }
    }
}
