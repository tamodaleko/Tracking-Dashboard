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
        'shopify_id',
        'first_name',
        'last_name',
        'address',
        'city',
        'zip',
        'phone',
        'total',
        'cost',
        'quantity',
        'free_shipping',
        'status',
    ];

    protected $casts = [
        'company_id' => 'int',
        'shopify_id' => 'int',
        'total' => 'float',
        'cost' => 'float',
        'quantity' => 'int',
        'free_shipping' => 'bool',
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
