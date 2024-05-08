<?php

namespace App\Http\Requests;

use App\Models\Stock;
use Illuminate\Foundation\Http\FormRequest;

class StockUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('stock'));
    }

    public function rules()
    {
        return [
            'item_id' => ['required'],
            'change_amount' => ['required', 'numeric'],
            'amount' => ['nullable'],
            'supplier_name' => ['required'],
        ];
    }
}
