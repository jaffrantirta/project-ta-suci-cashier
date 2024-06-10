<?php

namespace App\Http\Requests;

use App\Models\Opname;
use Illuminate\Foundation\Http\FormRequest;

class OpnameStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Opname::class);
    }

    public function rules()
    {
        return [
            'sku' => ['required', 'exists:items,sku'],
            'real_stock' => ['required', 'integer', 'min:0'],
            'diff_stock' => ['required', 'integer', 'min:0'],
            'doing_at' => ['required', 'date', 'before_or_equal:today'],
            'comment' => ['nullable', 'string'],
        ];
    }
}
