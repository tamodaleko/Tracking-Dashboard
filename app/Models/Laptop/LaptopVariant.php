<?php

namespace App\Models\Laptop;

use Illuminate\Database\Eloquent\Model;

class LaptopVariant extends Model
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
        'stock',
        'color',
        'screen',
        'available',
    ];

    protected $casts = [
        'laptop_id' => 'int',
        'price' => 'float',
        'stock' => 'int',
        'available' => 'bool',
    ];
}
