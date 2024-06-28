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
        'customer_address',
        'payment_method_text'
    ];

    public function getPaymentMethodTextAttribute()
    {
        if (!isset($this->attributes['payment_method'])) {
            return null;
        }
        return $this->attributes['payment_method'] == '1' ? 'Cash' : 'Transfer';
    }

    public function getCustomerNameAttribute()
    {
        // Check if 'attributes' key exists and is not null
        if (!isset($this->attributes['attributes'])) {
            return null;
        }

        // Decode JSON safely
        $attributes = json_decode($this->attributes['attributes'], true);

        // Ensure decoding was successful and 'customer_name' exists
        if (json_last_error() === JSON_ERROR_NONE && isset($attributes['customer_name'])) {
            return $attributes['customer_name'];
        }

        // Return null if JSON decoding fails or key is missing
        return null;
    }

    public function getCustomerAddressAttribute()
    {
        // Check if 'attributes' key exists and is not null
        if (!isset($this->attributes['attributes'])) {
            return null;
        }

        // Decode JSON safely
        $attributes = json_decode($this->attributes['attributes'], true);

        // Ensure decoding was successful and 'customer_address' exists
        if (json_last_error() === JSON_ERROR_NONE && isset($attributes['customer_address'])) {
            return $attributes['customer_address'];
        }

        // Return null if JSON decoding fails or key is missing
        return null;
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
