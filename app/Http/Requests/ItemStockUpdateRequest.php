<?php

namespace App\Http\Requests;

use App\Models\ItemStock;
use Illuminate\Foundation\Http\FormRequest;

class ItemStockUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('itemstock'));
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
