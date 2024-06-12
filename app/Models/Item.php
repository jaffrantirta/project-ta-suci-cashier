<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'price',
        'unit_of_stock',
    ];

    public function getStockAttribute()
    {
        return $this->stocks()->latest()->first();
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class)->latest();
    }

    /**
     * Get all of the opname for the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opname(): HasMany
    {
        return $this->hasMany(Opname::class);
    }
}
