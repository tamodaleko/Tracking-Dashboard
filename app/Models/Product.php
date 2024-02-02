<?php

namespace App\Models;

use App\Models\Campaign\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'campaign_id',
        'sp_id',
        'code',
        'name',
        'url',
        'image',
        'buying_price',
        'selling_price',
        'qty_warehouse',
        'qty_sending',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
