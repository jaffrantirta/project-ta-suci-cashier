<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Transaction::class);
    }

    public function rules()
    {
        return [
            'number' => ['forbidden'],
            'user_id' => ['forbidden'],
            'total_of_item' => ['forbidden'],
            'total_of_amount' => ['forbidden'],
            'address' => ['nullable'],
            'payment_method' => ['forbidden'],
        ];
    }
}
