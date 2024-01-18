<?php

namespace App\Models\Order;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'ingram_id',
        'payment_method_id',
        'total',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'country',
        'status',
    ];

    protected $casts = [
        'company_id' => 'int',
        'total' => 'float',
        'zip' => 'int',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
