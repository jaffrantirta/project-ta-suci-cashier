<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'price',
        'item_unit_id',
    ];

    protected $appends = [
        'stock',
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

    /**
     * Get the item_unit that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item_unit(): BelongsTo
    {
        return $this->belongsTo(ItemUnit::class);
    }
}
