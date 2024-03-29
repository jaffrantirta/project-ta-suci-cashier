<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'change_amount',
        'amount'
    ];

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $this->calculateTotalAmount();
    }

    private function calculateTotalAmount()
    {
        $exists = static::where('item_id', $this->item_id)->exists();
        if ($exists) {
            $sum = static::where('item_id', $this->item_id)->sum('change_amount');
            return $sum + $this->change_amount;
        } else {
            return $this->change_amount;
        }
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
