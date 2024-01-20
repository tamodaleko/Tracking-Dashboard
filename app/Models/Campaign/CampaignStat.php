<?php

namespace App\Models\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignStat extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'reach',
        'impressions',
        'spend',
        'spend_rsd',
        'cpc',
        'clicks',
        'conversions',
        'date',
    ];

    protected $casts = [
        'campaign_id' => 'int',
        'reach' => 'int',
        'impressions' => 'int',
        'spend' => 'float',
        'spend_rsd' => 'float',
        'cpc' => 'float',
        'clicks' => 'int',
        'conversions' => 'int',
        'date' => 'date',
    ];
}
