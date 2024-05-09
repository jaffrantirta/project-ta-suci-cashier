<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'issued_by',
        'total_of_item',
        'total_of_amount',
        'payment_method',
        'attributes',
        'pay_amount',
        'change_amount',
    ];

    // protected $casts = [
    //     'payment_method' => PaymentMethod::class,
    // ];

    protected $appends = [
        'customer_name',
        'customer_address'
    ];

    public function getCustomerNameAttribute()
    {
        $attributes = json_decode($this->attributes['attributes'], true);
        return $attributes['customer_name'] ?? null;
    }

    public function getCustomerAddressAttribute()
    {
        $attributes = json_decode($this->attributes['attributes'], true);
        return $attributes['customer_address'] ?? null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaction_details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
