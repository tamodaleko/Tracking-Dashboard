<?php

namespace App\Models\Laptop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laptop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(LaptopVariant::class);
    }

    public function warranties(): HasMany
    {
        return $this->hasMany(LaptopWarranty::class);
    }
}
