<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('item'));
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'sku' => [
                'required',
                'min:5',
                Rule::unique('items')->ignore($this->item->id),
            ],
            'price' => ['required', 'min:3', 'numeric']
        ];
    }
}
