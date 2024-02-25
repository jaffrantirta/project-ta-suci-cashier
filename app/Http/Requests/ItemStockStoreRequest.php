<?php

namespace App\Http\Requests;

use App\Models\ItemStock;
use Illuminate\Foundation\Http\FormRequest;

class ItemStockStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', ItemStock::class);
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
