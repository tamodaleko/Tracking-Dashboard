<?php

namespace App\Models\Campaign;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'product_id',
        'facebook_id',
        'name',
        'currency',
    ];

    protected $casts = [
        'company_id' => 'int',
        'product_id' => 'int',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getStats(?string $startDate = null, ?string $endDate = null): Collection
    {
        if (!$startDate || !$endDate) {
            $startDate = now()->format('Y-m-d');
            $endDate = now()->format('Y-m-d');
        }

        return CampaignStat::where('campaign_id', $this->id)
            ->whereDate('date', '>=', $startDate)
            ->whereDate('date', '<=', $endDate)
            ->get();
    }
}
