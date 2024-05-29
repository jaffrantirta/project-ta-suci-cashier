<?php

namespace App\Http\Requests;

use App\Models\Stock;
use Illuminate\Foundation\Http\FormRequest;

class StockStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Stock::class);
    }

    public function rules()
    {
        return [
            'item_id' => ['required'],
            'change_amount' => ['required', 'numeric'],
            'amount' => ['nullable'],
            'supplier_name' => ['required'],
            'number_of_invoice' => ['required'],
        ];
    }
}
