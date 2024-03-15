<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Item::class);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'sku' => ['required', 'min:5', 'unique:items,sku,except,id'],
            'price' => ['required', 'min:3', 'numeric']
        ];
    }
}
