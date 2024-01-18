<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'sp_id',
        'code',
        'name',
        'url',
        'image',
        'price',
        'qty_warehouse',
        'qty_sending',
    ];
}
