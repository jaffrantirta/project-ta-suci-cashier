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
            'price' => ['required', 'min:3', 'numeric'],
            'unit_of_stock' => ['required'],
        ];
    }
}
