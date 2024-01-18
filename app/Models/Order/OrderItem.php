<?php

namespace App\Models\Order;

use App\Models\Laptop\LaptopVariant;
use App\Models\Laptop\LaptopWarranty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'variant_id',
        'warranty_id',
        'total',
    ];

    protected $casts = [
        'order_id' => 'int',
        'variant_id' => 'int',
        'warranty_id' => 'int',
        'total' => 'float',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(LaptopVariant::class);
    }

    public function warranty(): BelongsTo
    {
        return $this->belongsTo(LaptopWarranty::class);
    }
}
