<?php

namespace App\Http\Requests;

use App\Models\ItemUnit;
use Illuminate\Foundation\Http\FormRequest;

class ItemUnitStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', ItemUnit::class);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
        ];
    }
}
