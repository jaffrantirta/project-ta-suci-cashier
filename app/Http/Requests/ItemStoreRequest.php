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
            'price' => ['required', 'min:3', 'numeric'],
            'unit_of_stock' => ['required'],
        ];
    }
}
