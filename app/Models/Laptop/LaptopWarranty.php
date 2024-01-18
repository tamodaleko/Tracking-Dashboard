<?php

namespace App\Models\Laptop;

use Illuminate\Database\Eloquent\Model;

class LaptopWarranty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laptop_id',
        'name',
        'sku',
        'price',
        'available',
    ];

    protected $casts = [
        'laptop_id' => 'int',
        'price' => 'float',
        'available' => 'bool',
    ];
}
